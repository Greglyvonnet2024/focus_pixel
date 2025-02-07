<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\ProductSell;
use App\Form\PaymentType;
use App\Repository\ProductSellRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]
    public function index(Request $request, SessionInterface $sessionInterface, EntityManagerInterface $entityManagerInterface): Response
    {
        if (!$this->getUser()){
            $this->addFlash('error', 'Vous devez être connecté !');
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(PaymentType::class);
        $form->handleRequest($request);  

        if($form->isSubmitted()&&$form->isValid()){

            $panier = $sessionInterface->get('cart', []);
            
            $command = new Order();
            $command->setDate()->setStatut()->setQuantity()->setUser($this->getUser());
            
            $total = 0;

            foreach($panier as $p){
                $produit = $entityManagerInterface->find(ProductSell::class, $p->getId());
                $total += $p->getPrix();
                $command->addProductSell($produit);
            }
            $command->setPrix($total);
            $entityManagerInterface->persist($command);
            $entityManagerInterface->flush();

            $sessionInterface->remove('cart');
            $sessionInterface->remove('numb_item');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'form'=> $form
        ]);
    }
}

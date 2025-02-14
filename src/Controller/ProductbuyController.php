<?php

namespace App\Controller;

use App\Entity\Order;
use index;
// use App\Entity\ProductBuy;
use App\Entity\ProductBuy;
use App\Form\FormSellType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductbuyController extends AbstractController
{
    #[Route('/productbuy', name: 'app_productbuy')]

    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('error', 'Veuillez vous connecter');
            return $this->redirectToRoute('app_login');
        }

            $FormSell = new ProductBuy();
        // dd($FormSell);
            $form = $this->createForm(FormSellType::class, $FormSell);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
            $FormSell->setUser($this->getUser())->setAccepted();
            $command = new Order();
            $command->setUser($this->getUser())->setDate()->setPrix($FormSell->getPrix())->setStatut()->setQuantity();
            $entityManagerInterface->persist($command);
            $FormSell->setCommand($command);
                // 4. Sauvegarder en base de données
                $entityManagerInterface->persist($FormSell);
                $entityManagerInterface->flush();
            }

                return $this->render('productbuy/index.html.twig', [
                    'controller_name' => 'ProductbuyController',
                    'form' => $form->createView()
                ]);
            


    }}
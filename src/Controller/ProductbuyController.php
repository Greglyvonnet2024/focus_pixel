<?php

namespace App\Controller;

use App\Form\FormSellType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductbuyController extends AbstractController
{
    #[Route('/productbuy', name: 'app_productbuy')]

    public function index(Request $request): Response{
        $form = $this->createForm(FormSellType::class);
        $form->handleRequest($request);

        return $this->render('productbuy/index.html.twig', [
            'controller_name' => 'ProductbuyController',
            'form'=>$form->createView()
        ]);        
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductbuyController extends AbstractController
{
    #[Route('/productbuy', name: 'app_productbuy')]
    public function index(): Response
    {
        return $this->render('productbuy/index.html.twig', [
            'controller_name' => 'ProductbuyController',
        ]);




        
    }
}

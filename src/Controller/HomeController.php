<?php

namespace App\Controller;

use App\Repository\ProductSellRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]

    public function index(ProductSellRepository $productSellRepository): Response
    {

        $items = $productSellRepository->findBy([], ['id' => 'DESC'], 4);
       
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'products'=> $items
        ]);
    }


}



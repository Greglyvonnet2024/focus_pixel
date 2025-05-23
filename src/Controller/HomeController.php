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

        // !!!! A changer le 'id' pour faire aparaitre le produit sa photo et son prix//
        $items = $productSellRepository->findBy(["isAvailable"=>true], ['id' => 'DESC'], 4);

        $promotions = $productSellRepository->findByPromotions();

        // $favoris = [];
        // if ($this->getUser()) {
        //     $favoris = $this->getUser()->getFavorites()->map(fn($f) => $f->getProduct()->getId())->toArray();
        // }


        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'products'=> $items,
            'promotions' =>$promotions
        ]);
    }
}



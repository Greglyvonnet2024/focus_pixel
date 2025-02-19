<?php

namespace App\Controller;

use App\Repository\ProductSellRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{category}', name: 'app_product')]
    public function index(string $category, ProductSellRepository $productSellRepository): Response
    {
        $produits = $productSellRepository->findBy(['category' => $category, 'isAvailable'=>true, 'isSold'=>false
    ]);

        // Permet l'affichage des produit avec le bouton en vente

        return $this->render('product/index.html.twig', [
            'products' => $produits,
            'titre'=>$category
        ]);
    }
}

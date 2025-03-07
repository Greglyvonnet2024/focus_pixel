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
        $produits = $productSellRepository->findBy([
            'category' => $category,
            'isAvailable' => true,
            'isSold' => false
        ]);

        // Permet l'affichage des produit avec le bouton en vente

        return $this->render('product/index.html.twig', [
            'products' => $produits,
            'titre' => $category
        ]);
    }



    #[Route('/promotions', name: 'app_promotions')]
    public function promotions(ProductSellRepository $productSellRepository): Response
    {
        // Récupère uniquement les produits qui ont une promotion
        $produits = $productSellRepository->findBy(['isAvailable' => true, 'isSold' => false]);


        $productPromo = [];
        foreach ($produits as $produit) {
            if ($produit->getPromotions() > 0) {
                $productPromo[] = $produit;
            }
        }

        // dump($productPromo);

        return $this->render('product/promotions.html.twig', [
            'products' => $productPromo,
            'titre' => 'Promotions'
        ]);
    }
}

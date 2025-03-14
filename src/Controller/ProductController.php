<?php

namespace App\Controller;

use App\Entity\ProductSell;
use App\Repository\FavoriteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductSellRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product/{category}', name: 'app_product')]
    public function index(string $category, ProductSellRepository $productSellRepository, FavoriteRepository $favoriteRepository): Response
    {
        $produits = $productSellRepository->findBy([
            'category' => $category,
            'isAvailable' => true,
            'isSold' => false
        ]);

        $user = $this->getUser();

        $favorite = [];
        if ($user){
            $favoriteUser = $favoriteRepository->findBy(['user' => $user]);
            foreach ($favoriteUser as $fav){
                $favorite[] = $fav->getProduct()->getId();
            }
        }


        // Permet l'affichage des produit avec le bouton en vente

        return $this->render('product/index.html.twig', [
            'products' => $produits,
            'favorite' => $favorite,
            'titre' => $category
        ]);
    }



    #[Route('/promotions', name: 'app_promotions')]
    public function promotions(ProductSellRepository $productSellRepository): Response
    {
        // Récupère uniquement les produits qui ont une promotion
        $produits = $productSellRepository->findBy(['category'=>'Promotions', 'isAvailable' => true, 'isSold' => false]);


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

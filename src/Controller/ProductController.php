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
        $produits = $productSellRepository->findBy(['category' => $category]);
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $produits,
            'titre' => $category
        ]);
    }
}

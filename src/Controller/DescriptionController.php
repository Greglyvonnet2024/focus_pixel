<?php

namespace App\Controller;

use App\Repository\FavoriteRepository;
use App\Repository\ProductSellRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DescriptionController extends AbstractController
{
    #[Route('/description/{id}', name: 'app_description')]
    public function index(int $id, ProductSellRepository $productSellRepository,FavoriteRepository $favoriteRepository): Response
    {
        $produit = $productSellRepository->find($id);
        
        $isFavorite = '';
        if ($this->getUser()) {
            $favoriteUser = $favoriteRepository->findBy(['user' => $this->getUser(), 'product'=>$produit]);
        if ($favoriteUser){
                $isFavorite = 'favoris';
        }
        }
        

        return $this->render('description/index.html.twig', [
            'controller_name' => 'DescriptionController',
            'produit' => $produit,
            'isFavorite'=> $isFavorite
        ]);
    }
}

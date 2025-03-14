<?php

namespace App\Controller;

use App\Entity\Favorite;
use App\Entity\ProductSell;
use App\Repository\FavoriteRepository;
use App\Repository\ProductSellRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FavoriteController extends AbstractController
{
    #[Route('/favorite', name: 'app_favorite', methods: ['POST'])]
    public function toggleFavorite( EntityManagerInterface $entityManager, Request $request, FavoriteRepository $favoriteRepository, ProductSellRepository $productSellRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $id = $data['id']; //$id = 9
    
        $user = $this->getUser();
        $product = $productSellRepository->find($id);
        $exist = $favoriteRepository->findOneBy(['user' => $user, 'product' => $product]);

        if($exist){
            $entityManager->remove($exist);
            $entityManager->flush();
            return $this->json(['isFavorite' => false]);
        }

        $favorite = new Favorite;
        $favorite->setProduct($product)->setUser($user);

        $entityManager->persist($favorite);
        $entityManager->flush();

        return $this->json(['isFavorite' => true]);

    }

}

    

<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductSellRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order', methods: ['POST'])]
    public function create(Request $request, ProductSellRepository $productSellRepository, EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->getUser(); // Récupérer l'utilisateur connecté
        $productIds = $data['productIds']; // Liste des ID des produits

        // if (!$user) {
        //     return $this->json(['error' => 'Utilisateur non authentifié'], 401);
        // }

        // if (empty($productIds)) {
        //     return $this->json(['error' => 'Aucun produit sélectionné'], 400);
        // }

        $order = new Order();
        $order->setUser($user);

        foreach ($productIds as $productId) {
            $product = $productSellRepository->find($productId); // Récupérer le produit en base
            if (!$product) {
                return $this->json(['error' => "Produit avec l'ID $productId non trouvé"], 404);
            }

            $order->addProductSell($product); // Ajouter le produit à la commande
        }

        $em->persist($order);
        $em->flush();

        return $this->json([
            'message' => 'Commande crée avec succès',
            'orderId' => $order->getId(),
            'total' => $order->getTotal()
        ]);
    }
}

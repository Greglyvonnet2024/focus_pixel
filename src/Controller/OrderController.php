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
        // $data = json_decode($request->getContent(), true);
        // $user = $this->getUser(); 
        // $productIds = $data['productIds'];

        // if (!$user) {
        //     return $this->json(['error' => 'Utilisateur non authentifié'], 401);
        // }

        // if (empty($productIds)) {
        //     return $this->json(['error' => 'Aucun produit sélectionné'], 400);
        // }

        // $order = new Order();
        // $order->setUser($user);

        // foreach ($productIds as $productId) {
        //     $product = $productSellRepository->find($productId); 
        //     if (!$product) {
        //         return $this->json(['error' => "Produit avec l'ID $productId non trouvé"], 404);
        //     }

        //     $order->addProductSell($product); 
        // }

        // $em->persist($order);
        // $em->flush();

        // return $this->json([
        //     'message' => 'Commande crée avec succès',
        //     'orderId' => $order->getId(),
        //     'total' => $order->getTotal()
        // ]);


        $data = json_decode($request->getContent(), true);
        $user = $this->getUser(); // Récupérer l'utilisateur connecté

        if (!$user) {
            return $this->json(['error' => 'Utilisateur non authentifié'], 401);
        }

        if (!isset($data['products']) || empty($data['products'])
        ) {
            return $this->json(['error' => 'Aucun produit sélectionné'], 400);
        }

        $order = new Order();
        $order->setUser($user);

        foreach ($data['products'] as $productData) {
            $product = $productSellRepository->find($productData['id']);
            if (!$product) {
                return $this->json(['error' => "Produit avec l'ID {$productData['id']} non trouvé"], 404);
            }

            // if ($product->isSold()) {
            //     return $this->json(['error' => "Le produit {$product->getId()} a déjà été vendu"], 400);
            // }

            // $orderItem = new OrderItem();
            $order->addProductSell($product);
            $order->setQuantity(1); // Chaque produit est unique
            $order->setPrix($product->getPrice());

            $order->addProductSell($product);
            $product->setSold(true); // Marquer le produit comme vendu

            $em->persist($order);
            $em->persist($product);
        }

        $em->persist($order);
        $em->flush();

        return $this->json([
            'message' => 'Commande créé avec succès',
            'order' => $order->getId(),
            'total' => $order->getTotal(),
        ]);


    }
}

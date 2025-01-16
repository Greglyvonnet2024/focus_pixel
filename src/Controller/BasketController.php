<?php

namespace App\Controller;

use App\Repository\ProductSellRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'app_basket')]
    public function index(SessionInterface $sessionInterface): Response
    {

        $product = $sessionInterface->get('cart', []);
        return $this->render('basket/index.html.twig', [
            'controller_name' => 'panier',
            'product' => $product
        ]);
    }

    #[Route('/add', name: 'app_add')]
    public function add(Request $request, ProductSellRepository $productSellRepository, SessionInterface $sessionInterface): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $product = $productSellRepository->find($id);
        $cart = $sessionInterface->get('cart', []);
        foreach ($cart as $c) {
            if ($c->getId() == $product->getId()) {
                return new JsonResponse(['error_doublons' => 'le produit est déja dans votre panier']);
            }
        }

        $cart[] = $product;

        $sessionInterface->set('cart', $cart);
        $numb = count($cart);
        $sessionInterface->set('numb_item', $numb);

        return new JsonResponse(['success'=> 'Votre article a été ajouté au panier', 'nb' => $numb]);
    }

#[Route('/supp', name: 'app_supp')]

public function supp(Request $request, SessionInterface $sessionInterface){
        $data = json_decode($request->getContent(), true);

}

}

<?php

namespace App\Controller\ItemPages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccessoryController extends AbstractController
{
    #[Route('/accessory', name: 'app_accessory')]
    public function index(): Response
    {
        return $this->render('accessory/index.html.twig', [
            'controller_name' => 'Accessoires',
        ]);
    }
}

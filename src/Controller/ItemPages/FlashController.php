<?php

namespace App\Controller\ItemPages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FlashController extends AbstractController
{
    #[Route('/flash', name: 'app_flash')]
    public function index(): Response
    {
        return $this->render('flash/index.html.twig', [
            'controller_name' => 'Flashs',
        ]);
    }
}

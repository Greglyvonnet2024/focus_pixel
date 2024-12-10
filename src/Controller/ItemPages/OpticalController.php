<?php

namespace App\Controller\ItemPages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OpticalController extends AbstractController
{
    #[Route('/optical', name: 'app_optical')]
    public function index(): Response
    {
        return $this->render('optical/index.html.twig', [
            'controller_name' => 'Optiques',
        ]);
    }
}

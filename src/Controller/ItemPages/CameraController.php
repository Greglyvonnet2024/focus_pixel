<?php

namespace App\Controller\ItemPages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CameraController extends AbstractController
{
    #[Route('/camera', name: 'app_camera')]
    public function index(): Response
    {
        return $this->render('Camera/index.html.twig', [
            'controller_name' => 'Boitiers',
        ]);
    }
}

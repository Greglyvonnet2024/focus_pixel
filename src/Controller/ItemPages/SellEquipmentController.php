<?php

namespace App\Controller\ItemPages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SellEquipmentController extends AbstractController
{
    #[Route('/sell/equipment', name: 'app_sell_equipment')]
    public function index(): Response
    {
        return $this->render('sell_equipment/index.html.twig', [
            'controller_name' => 'Vendez votre matériel',
        ]);
    }
}

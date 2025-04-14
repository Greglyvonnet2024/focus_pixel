<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InfosController extends AbstractController
{
    #[Route('/mentions', name: 'app_mentions')]
    public function mentions(): Response
    {
        return $this->render('infos/mentions.html.twig');
    }

    #[Route('/us', name: 'app_us')]
    public function us(): Response
    {
        return $this->render('infos/us.html.twig');
    }
}

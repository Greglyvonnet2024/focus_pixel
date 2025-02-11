<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        if(!$this -> getUser()){
            return $this->redirectToRoute('app_login');
        }
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'Profil',
        ]);
    }
}

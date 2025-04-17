<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class loginController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(
    
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $hasher
    ): Response {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $user = $userRepository->findOneBy(['email' => $data['email']]);

            if (!$user || !$hasher->isPasswordValid($user, $data['password'])) {
                $this->addFlash('error', 'Identifiants incorrects');
            } else {
                
                $this->addFlash('success', 'Connexion réussie !');
                return $this->redirectToRoute('app_home'); 
            }
        }

        return $this->render('login/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

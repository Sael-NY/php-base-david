<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    #[Route('/login', 'login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // Les erreurs quand peut avoir quand on se connecte
        $error = $authenticationUtils->getLastAuthenticationError();
        // Prend le champs de la derniere connexion si on fait une erreur
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('public/login.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername
        ]);

    }

}
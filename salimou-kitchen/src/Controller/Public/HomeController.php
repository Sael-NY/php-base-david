<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    #[Route('/', 'home', methods: ['GET'])]
    public function showHomePage() {

        return $this->render('public/home.html.twig');

    }

}
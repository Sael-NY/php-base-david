<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/admin', 'admin_dashboard', methods: ['GET'])]
    public function index()
    {

        return $this->render('admin/dashboard.html.twig');
    }
}
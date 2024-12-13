<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ListAdminsController extends AbstractController
{
    #[Route('/admin/list/', name: 'admin_list')]
    public function listAdmins(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        return $this->render('admin/list_admins.html.twig', [
            'users' => $users,
        ]);

    }
}
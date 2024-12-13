<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AdminUserController extends AbstractController
{
    #[Route('/admin/logout', 'logout')]
    public function logout()
    {
        // Elle est utilisé par symfony cette route en question dans le security.yaml
        // pour gérer la deconnexion
    }

    #[Route('/admin/registration', 'registration')]

public function create(UserPasswordHasherInterface $userPasswordHasher, Request $request, EntityManagerInterface $entityManager)
    {
        $user = new User();

        // Créer un formulaire
        $userForm = $this -> createForm(UserType::class, $user);
        $userForm -> handleRequest($request);

            // Onn passe aux sauvegardes de user
            if ($userForm -> isSubmitted() && $userForm -> isValid()) {

            // On récupère le mot de passe
            $password = $userForm->get('password')->getData();
            // On le passe dans un hash pour sécuriser le mot de passe
            $hashedPassword = $userPasswordHasher->hashPassword($user, $password);

            // On sauvegarde le mot de passe
            $user->setPassword($hashedPassword);
            // On met un role à chaque utilisateur
            $user -> setRoles(['ROLE_ADMIN']);

            // Et on passe dans une sauvegarde en SQL
            $entityManager->persist($user);
            $entityManager->flush();


                return $this->redirectToRoute('admin_list');
            }

        $userFormView = $userForm->createView();

        return $this->render('admin/create_user.html.twig',[
            'userFormView' => $userFormView,
            ]);
    }

    #[Route('/admin/delete/{id}', 'delete_user')]
    public function delete(int $id, UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $user = $userRepository ->find($id);
        $authenticatedUser = $this -> getUser();

        if($id === $authenticatedUser-> getId() ){
            $this->addFlash('success', "Vous ne pouvez pas supprimer cet utilisateur");
            return $this->redirectToRoute('admin_list');
        }

        $entityManager -> remove($user);

        $entityManager->flush();

        return $this->redirectToRoute('admin_list');
    }

    #[Route('/admin/update/{id}', 'update_user', methods: ['GET', 'POST'])]
public function update(int $id, UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher)
    {
        $user = $userRepository ->find($id);
        $userForm = $this -> createForm(UserType::class, $user);
        $userForm -> handleRequest($request);

        if ($userForm -> isSubmitted() && $userForm -> isValid()) {
            $password = $userForm->get('password')->getData();

            if($password){

                $hashedPassword = $userPasswordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
            }

            $entityManager->persist($user);
            $entityManager->flush();


            return $this->redirectToRoute('admin_list');
        }

        $userFormView = $userForm->createView();

        return $this->render('admin/update_user.html.twig',[
            'userFormView' => $userFormView,
        ]);
    }
}
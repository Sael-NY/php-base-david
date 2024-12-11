<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use App\Form\AdminRecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{


    #[Route('/admin/recipe/create', name: 'admin_create_recipe')]

public function create(): Response
    {

        $recipe = new Recipe();

        $adminRecipeFrom = $this->createForm(AdminRecipeType::class, $recipe);
        $adminRecipeFormView = $adminRecipeFrom->createView();



        return $this->render('admin/recipe/create.html.twig', [
            'adminRecipeFormView' => $adminRecipeFormView,
        ]);
    }

}

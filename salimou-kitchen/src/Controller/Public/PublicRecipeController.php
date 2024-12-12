<?php

namespace App\Controller\Public;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PublicRecipeController extends AbstractController
{
    #[Route('/public/recipe', name: 'app_public_recipe')]
    public function index(): Response
    {
        return $this->render('public_recipe/index.html.twig', [
            'controller_name' => 'PublicRecipeController',
        ]);
    }
    #[Route('/recipes', name: 'list_recipes', methods: ['GET'])]
    public function listPublishRecipes(RecipeRepository $recipeRepository): Response
    {
        $publishedRecipes = $recipeRepository->findBy(['isPublished' => true]);

        return $this->render('public/recipe/list_recipe.html.twig', [
            'publishedRecipes' => $publishedRecipes,
        ]);

    }

    #[Route('/recipes/show/{id}', name: 'show_recipe', methods: ['GET'])]
    public function showRecipe(int $id, RecipeRepository $recipeRepository): Response
    {
        $recipe = $recipeRepository->find($id);
        if (!$recipe || !$recipe->isPublished()) {
            $notFoundResponse = new Response('Recette non trouvée', 404);
            return $notFoundResponse;
        }

        return $this->render('public/recipe/show_recipe.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}

<?php

namespace App\Controller\Admin\Recipe;

use App\Entity\Recipe;
use App\Form\AdminRecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{


    #[Route('/admin/recipe/create', name: 'admin_create_recipe', methods: ['GET', 'POST'])]

    public function create(Request $request, EntityManagerInterface $entityManager, ParameterBagInterface $parameterBag): Response
    {

        $recipe = new Recipe();

        $adminRecipeForm = $this->createForm(AdminRecipeType::class, $recipe);

        $adminRecipeForm->handleRequest($request);

        if ($adminRecipeForm->isSubmitted() && $adminRecipeForm->isValid()) {

            // je récupère le fichier envoyé dans le champs image du formulaire
            $recipeImage = $adminRecipeForm->get('image')->getData();

            // s'il y a bien une image envoyée
            if ($recipeImage) {
                // je génère un nom unique pour l'image, en gardant l'extension
                // originale (.jpeg, .png etc)
                $imageNewName = uniqid() . '.' . $recipeImage->guessExtension();

                // je récupère grâce à la classe ParameterBag, le chemin
                // vers la racine du projet
                $rootDir = $parameterBag->get('kernel.project_dir');
                // je génère le chemin vers le dossier uploads (dans le dossier public)
                $uploadDir = $rootDir . '/public/assets/upload';
                // je déplace mon image dans le dossier uploads, en lui donnant
                // le nom unique
                $recipeImage->move($uploadDir, $imageNewName);
                // je stocke dans l'entité le nouveau nom de l'image
                $recipe->setImage($imageNewName);
            }

            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash('success', 'Recipe created.');
        }

        $adminRecipeFormView = $adminRecipeForm->createView();


        return $this->render('admin/recipe/create.html.twig', [
            'adminRecipeFormView' => $adminRecipeFormView,
        ]);
    }
    #[Route('/admin/recipe/list', name: 'admin_list_recipes', methods: ['GET'])]
    public function listRecipes(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();
        return $this->render('admin/recipe/list_recipes.html.twig', [
            'recipes' => $recipes
        ]);
    }
    #[Route('/admin/recipe/{id}/delete', name: 'admin_recipe_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function deleteRecipe(int $id, RecipeRepository $recipeRepository, EntityManagerInterface $entityManager): Response
    {
        $recipe = $recipeRepository->find($id);
        $entityManager->remove($recipe);
        $entityManager->flush();

        $this->addFlash('success', 'Recipe deleted.');
        return $this->redirectToRoute('admin_list_recipes');
    }

    #[Route('/admin/recipe/{id}/update', name: 'admin_recipe_update', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
public function updateRecipe(int $id, RecipeRepository $recipeRepository, EntityManagerInterface $entityManager, ParameterBagInterface $parameterBag, Request $request): Response
    {
        $recipe = $recipeRepository->find($id);
        $adminRecipeForm = $this->createForm(AdminRecipeType::class, $recipe);
        $adminRecipeForm->handleRequest($request);

        if ($adminRecipeForm->isSubmitted()) {

            $recipeImage = $adminRecipeForm->get('image')->getData();

            if ($recipeImage) {

                $imageNewName = uniqid() . '.' . $recipeImage->guessExtension();

                $rootDir = $parameterBag->get('kernel.project_dir');

                $uploadDir = $rootDir . '/public/assets/upload';
                $recipeImage->move($uploadDir, $imageNewName);
                $recipe->setImage($imageNewName);
            }
            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash('success', 'Recipe updated.');
        }
        $adminRecipeFormView = $adminRecipeForm->createView();

        return $this->render('admin/recipe/update.html.twig', [
            'adminRecipeFormView' => $adminRecipeFormView,
            'recipe' => $recipe
        ]);
    }

    #[Route('/category/{id}', name: 'recipes_category')]
    public function recipesByCategory(int $id, CategoryRepository $categoryRepository)
    {

        $category = $categoryRepository->find($id);

        $recipes = $category->getRecipes();

        return $this->render('public/category/list_category.html.twig', [
            'category' => $category,
            'recipes' => $recipes,
        ]);
    }

}

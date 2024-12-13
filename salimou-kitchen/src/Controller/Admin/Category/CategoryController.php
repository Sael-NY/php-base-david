<?php

namespace App\Controller\Admin\Category;

use App\Entity\Category;
use App\Form\AdminRecipeType;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/admin/categorys', name: 'admin_category')]
    public function list(Request $request,CategoryRepository $categoryRepository, RecipeRepository $recipeRepository)
    {
        $form = $this->createForm(AdminRecipeType::class);
        $form->handleRequest($request);

        $categorys = $categoryRepository->findAll();
        $recipes = $recipeRepository->findAll();


        return $this->render('admin/category/list.html.twig', [
            'categorys' => $categorys,
            'recipes' => $recipes
        ]);
    }
    #[Route('/admin/category/create', name: 'admin_category_create')]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
            $category = new Category();
            $categoryForm = $this -> createForm(CategoryType::class, $category);
            $categoryForm ->handleRequest($request);

            if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {

                $entityManager->persist($category);
                $entityManager->flush();

                return $this -> redirectToRoute('admin_category');
            }

            $categoryFormView = $categoryForm -> createView();

            return $this -> render('admin/category/create.html.twig', [
                'categoryFormView' => $categoryFormView,
            ]);
    }
    #[Route('/admin/category/update/{id}', name: 'admin_update_category')]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('admin_category');
        }

        $categoryFormView = $categoryForm->createView();

        return $this->render('admin/category/update.html.twig', [
            'categoryFormView' => $categoryFormView,
            'category' => $category,
        ]);
    }

    #[Route('/admin/category/delete/{id}', name: 'admin_delete_category')]
    public function delete(int $id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager) {

        $category = $categoryRepository->find($id);

        $entityManager->remove($category);

        $entityManager->flush();

        return $this->redirectToRoute('admin_list');
    }
}
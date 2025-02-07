<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'category_show')]
    public function show(string $slug, CategoryRepository $categoryRepository): Response
    {
        // Find the category entity by slug
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        // Handle case where category is not found
        if (!$category) {
            throw $this->createNotFoundException('Category not found');
        }

        return $this->render('category/index.html.twig', [
            'category' => $category,  // Pass the category entity
            'categoryRepository' => $categoryRepository, // Pass the repository
        ]);
    }
}




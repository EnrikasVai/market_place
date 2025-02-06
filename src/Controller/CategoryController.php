<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'category_show')]
    public function show(CategoryRepository $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
            //'subcategories' => $category->getChildren(),
        ]);
    }
}




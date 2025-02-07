<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Listing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Category::class)->findBy(['parent'=>null]);

        $listings = $entityManager->getRepository(Listing::class)->findAll();

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'listings' => $listings
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Listing;
use App\Form\ListingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ListingController extends AbstractController
{
    #[Route('/listing', name: 'listing_list', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $listings = $entityManager->getRepository(Listing::class)->findAll();

        return $this->render('listing/index.html.twig', [
            'listings' => $listings,
        ]);
    }

    #[Route('/listing/new', name: 'listing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $listing = new Listing();
        $form = $this->createForm(ListingType::class, $listing);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listing);
            $entityManager->flush();

            return $this->redirectToRoute('listing_list');
        }

        return $this->render('listing/new.html.twig', [
            'form' => $form,
        ]);
    }
}

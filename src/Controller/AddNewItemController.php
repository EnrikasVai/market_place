<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddNewItemController extends AbstractController
{
    #[Route('/create-listing', name: 'app_add_new_item')]
    public function index(): Response
    {
        return $this->render('add_new_item/index.html.twig', [
            'controller_name' => 'AddNewItemController',
        ]);
    }
}

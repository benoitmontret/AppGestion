<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TuteurController extends AbstractController
{
    #[Route('/tuteur', name: 'app_tuteur')]
    public function index(): Response
    {
        return $this->render('tuteur/index.html.twig', [
            'controller_name' => 'TuteurController',
        ]);
    }
}

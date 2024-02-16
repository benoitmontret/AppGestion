<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TuteurController extends AbstractController
{
    #[Route('/tuteur', name: 'app_tuteur')]
    public function index(): Response
    {
        return $this->render('tuteur/index.html.twig', [
            'controller_name' => 'TuteurController',
        ]);
    }

    // recuperation de la liste des tuteurs
    #[Route('/tuteur/liste', name: 'tuteurListe')]
    public function tuteurListe(EntityManagerInterface $manager ): Response
    {
        $tuteurRepo = $manager->getRepository (Utilisateur::class);
        $tuteurListe = $tuteurRepo->findAll();

        return $this->render('tuteur/liste.html.twig', 
        [
            'tuteurListe' => $tuteurListe
        ]);
    }

// Afficher les info d'un tuteur
    #[Route('/tuteur/{id}', name: 'tuteur')]
    public function tuteur(Utilisateur $tuteur,EntityManagerInterface $manager): Response
    {
    
        return $this->render('tuteur/tuteur.html.twig', [
            "tuteur" => $tuteur
        ]);
    }

}

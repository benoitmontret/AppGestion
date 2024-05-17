<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TuteurController extends AbstractController
{
    // #[Route('/tuteur', name: 'app_tuteur')]
    // #[IsGranted('tuteur')]
    // public function index(): Response
    // {
    //     return $this->render('tuteur/index.html.twig', [
    //         'controller_name' => 'TuteurController',
    //     ]);
    // }

    // Afficher les info d'un tuteur
    #[Route('/tuteur', name: 'tuteur')]
    #[IsGranted('ROLE_TUTEUR')]
    public function tuteur(Utilisateur $tuteur,EntityManagerInterface $manager): Response
    {
    
        return $this->render('tuteur/tuteur.html.twig', [
            "tuteur" => $tuteur
        ]);
    }

    // recuperation de la liste des tuteurs ##route de travail##
    #[Route('/tuteur/liste', name: 'tuteurListe')]
    // #[IsGranted('tuteur')]
    public function tuteurListe(EntityManagerInterface $manager ): Response
    {
        $tuteurRepo = $manager->getRepository (Utilisateur::class);
        $tuteurListe = $tuteurRepo->findAll();

        return $this->render('tuteur/liste.html.twig', 
        [
            'tuteurListe' => $tuteurListe
        ]);
    }

    #[Route('/apprenti/{id}', name: 'apprenti')]
    // #[IsGranted('tuteur')]
    public function apprenti(Utilisateur $apprenti,EntityManagerInterface $manager): Response
    {
    
        return $this->render('tuteur/apprenti.html.twig', [
            "apprenti" => $apprenti
        ]);
    }

}

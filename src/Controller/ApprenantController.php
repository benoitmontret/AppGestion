<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApprenantController extends AbstractController
{
    // #[Route('/apprenant', name: 'app_apprenant')]
    // #[IsGranted('apprenant')]
    // public function index(): Response
    // {
    //     return $this->render('apprenant/index.html.twig', [
    //         'controller_name' => 'ApprenantController',
    //     ]);
    // }

    // Afficher les info d'un apprenant
    #[Route('/apprenant', name: 'apprenant')]
    #[IsGranted('ROLE_APPRENANT')]
    public function apprenant(Utilisateur $utilisateur, Security $security, EntityManagerInterface $manager): Response
    {
        $utilisateur = $security->getUser();

        return $this->render('apprenant/apprenant.html.twig', [
            "utilisateur" => $utilisateur,
        ]);
    }
    
    // recuperation de la liste des apprenants
    #[Route('/apprenant/liste', name: 'apprenantListe')]
    // #[IsGranted('')]
    public function apprenantListe(EntityManagerInterface $manager ): Response
    {
        $apprenantRepo = $manager->getRepository (Utilisateur::class);
        $apprenantListe = $apprenantRepo->findAll( );
    
        return $this->render('apprenant/liste.html.twig', 
        [
            'apprenantListe' => $apprenantListe
        ]);
    }
}

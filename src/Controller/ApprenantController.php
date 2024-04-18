<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApprenantController extends AbstractController
{
    #[Route('/apprenant', name: 'app_apprenant')]
    public function index(): Response
    {
        return $this->render('apprenant/index.html.twig', [
            'controller_name' => 'ApprenantController',
        ]);
    }

        // recuperation de la liste des apprenants
        #[Route('/apprenant/liste', name: 'apprenantListe')]
        public function apprenantListe(EntityManagerInterface $manager ): Response
        {
            $apprenantRepo = $manager->getRepository (Utilisateur::class);
            $apprenantListe = $apprenantRepo->findAll( );
    
            return $this->render('apprenant/liste.html.twig', 
            [
                'apprenantListe' => $apprenantListe
            ]);
        }
    
    // Afficher les info d'un apprenant
        #[Route('/apprenant/{id}', name: 'apprenant')]
        public function apprenant(Utilisateur $apprenant,EntityManagerInterface $manager): Response
        {
            
            return $this->render('apprenant/apprenant.html.twig', [
                "apprenant" => $apprenant
            ]);
        }
    
}

<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormateurController extends AbstractController
{
    #[Route('/formateur', name: 'app_formateur')]
    public function index(): Response
    {
        return $this->render('formateur/index.html.twig', [
            'controller_name' => 'FormateurController',
        ]);
    }
// recuperation de la liste des formateurs
    #[Route('/formateur/liste', name: 'formateurListe')]
    public function formateurListe(EntityManagerInterface $manager ): Response
    {
        $formateurRepo = $manager->getRepository (Utilisateur::class);
        $formateurListe = $formateurRepo->findAll();

        return $this->render('formateur/liste.html.twig', 
        [
            'formateurListe' => $formateurListe
        ]);
    }

// Afficher les info d'un formateur
    #[Route('/formateur/{id}', name: 'formateur')]
    public function formateur(Utilisateur $formateur,EntityManagerInterface $manager): Response
    {
    
        return $this->render('formateur/formateur.html.twig', [
            "formateur" => $formateur
        ]);
    }
}


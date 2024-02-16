<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Utilisateur;
use App\Entity\FairePartie;
use App\Entity\Matieres;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    // #[Route('/home', name: 'app_home')]
    // public function index(): Response
    // {
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }

    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->render('home/accueil.html.twig');
    }

    // afficher les formations et les matiere
    #[Route('/listeFormation', name: 'listeFormation')]
    public function listeFormation(EntityManagerInterface $manager ): Response
    {
        $formationRepo = $manager->getRepository (Formation::class);
        $listeFormation = $formationRepo->findAll();

        return $this->render('home/listeformation.html.twig', 
        [
            'listeFormation' => $listeFormation
        ]);
    }

    // Afficher les info d'une formation
    #[Route('/formation/{id}', name: 'formation')]
    public function formation(Formation $formation,EntityManagerInterface $manager): Response
    {
    
        return $this->render('home/formation.html.twig', [
            "formation" => $formation
        ]);
    }
}

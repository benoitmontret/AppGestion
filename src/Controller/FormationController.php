<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Matiere;
use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
    // #[Route('/formation', name: 'app_formation')]
    // public function index(): Response
    // {
    //     return $this->render('formation/index.html.twig', [
    //         'controller_name' => 'FormationController',
    //     ]);
    // }

    // afficher les formations et les matiere route de travail
    #[Route('/listeFormation', name: 'listeFormation')]
    public function listeFormation(EntityManagerInterface $manager ): Response
    {
        $formationRepo = $manager->getRepository (Formation::class);
        $listeFormation = $formationRepo->findAll();
        
        return $this->render('formation/liste.html.twig', 
        [
            'listeFormation' => $listeFormation
        ]);
    }

    // Afficher les info d'une formation route de travail
    #[Route('/formation/{id}', name: 'formation')]
    public function formation(Formation $formation,EntityManagerInterface $manager): Response
    {
        return $this->render('formation/formation.html.twig', [
            "formation" => $formation
        ]);
    }

    // Afficher le programme d'un module
    #[Route('/programme/{id}', name : 'programme')]
    public function programme(Module $module,EntityManagerInterface $manager): Response
    {
        return $this->render('formation/programme.html.twig', [
            "module" => $module
        ]);
    }
}

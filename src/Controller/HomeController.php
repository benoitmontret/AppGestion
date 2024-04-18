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


}
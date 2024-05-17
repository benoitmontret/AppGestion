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


    // Afficher le programme d'un module
    #[Route('/programme/{id}', name : 'programme')]
    public function programme(Module $module,EntityManagerInterface $manager): Response
    {
        return $this->render('formation/programme.html.twig', [
            "module" => $module
        ]);
    }
}

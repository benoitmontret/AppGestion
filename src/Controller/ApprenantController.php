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

}

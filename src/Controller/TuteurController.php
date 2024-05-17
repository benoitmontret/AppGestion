<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

class TuteurController extends AbstractController
{

    // Afficher les info d'un tuteur
    #[Route('/tuteur', name: 'tuteur')]
    #[IsGranted('ROLE_TUTEUR')]
    public function tuteur2(Utilisateur $tuteur, Security $security,EntityManagerInterface $manager): Response
    {
        $tuteur = $security->getUser();
        return $this->render('tuteur/tuteur.html.twig', [
            "tuteur" => $tuteur
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

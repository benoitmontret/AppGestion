<?php

namespace App\Controller;

use App\Entity\Matieres;
use App\Entity\Formation;
use App\Entity\FairePartie;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{


    #[Route('/', name: 'accueil')]
    public function accueil(Security $security): Response
    {
        $user = $security->getUser();

        if ($user) {
            $roles = $user->getRoles();

            if (in_array('ROLE_APPRENANT', $roles, true)) {
                return $this->redirectToRoute('apprenant');
            } elseif (in_array('ROLE_TUTEUR', $roles, true)) {
                return $this->redirectToRoute('tuteur');
            } elseif (in_array('ROLE_FORMATEUR', $roles, true)) {
                return $this->redirectToRoute('formateur');
            } else {
                return $this->render('home/accueil.html.twig');
            }
        } else {
            return $this->render('home/accueil.html.twig'); 
        }
    }


}
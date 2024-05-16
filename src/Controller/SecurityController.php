<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SecurityController extends AbstractController
{

    use TargetPathTrait;

    
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/security.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }


    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout()
    {

    }


    #[Route('/redirection', name: 'app_redirection', methods: ['GET'])]
    public function redirection(Security $security): Response
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
                return $this->redirectToRoute('accueil');
            }
        }
    }
}
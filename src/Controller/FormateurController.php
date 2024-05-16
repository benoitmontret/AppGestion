<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\NoteType;
use App\Entity\Formation;
use App\Entity\Utilisateur;
use App\Form\ProgrammeType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;

class FormateurController extends AbstractController
{
    // #[Route('/formateur', name: 'app_formateur')]
    // #[IsGranted('prof')]
    // public function index(): Response
    // {
    //     return $this->render('formateur/index.html.twig', [
    //         'controller_name' => 'FormateurController',
    //     ]);
    // }

    // Afficher les info d'un formateur
    #[Route('/formateur', name: 'formateur')]
    #[IsGranted('ROLE_FORMATEUR')]
    public function formateur(Utilisateur $formateur, Security $security, EntityManagerInterface $manager): Response
    {
        $formateur = $security->getUser();
        
        $formationRepo = $manager->getRepository (Formation::class);
        $listeFormation = $formationRepo->findAll();

        return $this->render('formateur/formateur.html.twig', [
            "formateur" => $formateur,
            'listeFormation' => $listeFormation
        ]);
    }

// recuperation de la liste des formateurs
    #[Route('/formateur/liste', name: 'formateurListe')]
    // #[IsGranted('prof')]
    public function formateurListe(EntityManagerInterface $manager ): Response
    {
        $formateurRepo = $manager->getRepository (Utilisateur::class);
        $formateurListe = $formateurRepo->findAll();

        return $this->render('formateur/liste.html.twig', 
        [
            'formateurListe' => $formateurListe
        ]);
    }

    #[Route('/formateur_prog/{id}', name : 'formateur_prog')]
    // #[IsGranted('prof')]
    public function formateur_prog(Module $module,EntityManagerInterface $manager): Response
    {
        return $this->render('formateur/prog.html.twig', [
            "module" => $module
        ]);
    }

    #[Route('/formateur_note/{id}', name: 'formateur_note')]
    // #[IsGranted('prof')]
    public function formateur_note(Module $module,EntityManagerInterface $manager): Response
    {
        return $this->render('formateur/note.html.twig', [
            "module" => $module
        ]);
    }

    #[Route('/editProgramme/{id}', name: 'editProgramme')]
    // #[IsGranted('prof')]
    public function editProgramme(Module $module, EntityManagerInterface $manager, Request $request): Response
    {
        $id = $module->getId();
        
        $form = $this->createForm(ProgrammeType::class, $module);
        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $module =$form ->getData();
            $manager->persist($module);
            $manager->flush();
            $this -> addFlash('success', 'Le programme a été modifié');

            return $this->redirectToRoute('formateur_prog', ['id' => $id]);
        }

        return $this->render('formateur/editProgramme.html.twig', 
        ["form"=>$form->createView()]
        );
    }

    #[Route('/mettreNote/{id}', name: 'mettreNote')]
    // #[IsGranted('prof')]
    public function mettreNote(Module $module, EntityManagerInterface $manager, Request $request): Response
    {
        $id = $module->getId();
        
        $form = $this->createForm(NoteType::class, $module);
        $form-> handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $module =$form ->getData();
        //     $manager->persist($module);
        //     $manager->flush();
        //     $this -> addFlash('success', 'Les notes ont  été modifiées');

        //     return $this->redirectToRoute('formateur_prog', ['id' => $id]);
        // }

        return $this->render('formateur/mettreNote.html.twig', 
        ["form"=>$form->createView()]
        );
    }
}
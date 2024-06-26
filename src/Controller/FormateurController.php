<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\NoteType;
use App\Entity\Matiere;
use App\Entity\AvoirNote;
use App\Entity\Formation;
use App\Entity\Utilisateur;
use App\Form\ProgrammeType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;

class FormateurController extends AbstractController
{
    // #[Route('/formateur', name: 'app_formateur')]
    // public function index(): Response
    // {
    //     return $this->render('formateur/index.html.twig', [
    //         'controller_name' => 'FormateurController',
    //     ]);
    // }

// recuperation de la liste des formateurs ##route de travail##
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

        $formationRepo = $manager->getRepository (Formation::class);
        $listeFormation = $formationRepo->findAll();

        return $this->render('formateur/formateur.html.twig', [
            "formateur" => $formateur,
            'listeFormation' => $listeFormation
        ]);
    }

// routes pour afficher et modifier le programme d'une matière pour un formation 
    #[Route('/formateur_prog/{id}', name : 'formateur_prog')]
    public function formateur_prog(Module $module,EntityManagerInterface $manager): Response
    {
        return $this->render('formateur/prog.html.twig', [
            "module" => $module
        ]);
    }

    
    #[Route('/editProgramme/{id}', name: 'editProgramme')]
    public function editProgramme(int $id, Module $module, EntityManagerInterface $manager, Request $request): Response
    {
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

// routes pour les notes
    #[Route('/formateur_notes/{id}', name: 'formateur_notes')]
    public function formateur_notes(Module $module,EntityManagerInterface $manager): Response
    {
        return $this->render('formateur/notes.html.twig', [
            "module" => $module
        ]);
    }

//pour modifier la note il n'y a besoin que de l'id d'AvoirNote puisqu'elle existe déjà la matièere et l'apprenant sont déjà connu
    #[Route('/modifierNote/{id}', name: 'modifierNote')]
    public function modifierNote(AvoirNote $note, EntityManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form-> handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $note =$form ->getData();
            $manager->persist($note);
            $manager->flush();
            $this -> addFlash('success', 'La note a été modifiée');
            
            return $this->redirectToRoute('formateurListe'); //modifier la route par redirection login
            
        }

        return $this->render('formateur/modifierNote.html.twig', [
            "form"=> $form->createView(),
            "note" => $note
        ]
        );
    }

//pour ajouter une note ils faut les id de la matière et de l'apprenant
    #[Route('/ajouterNote/{idApp}/{idMat}', name: 'ajouterNote')]
    public function ajouterNote(int $idApp, int $idMat, EntityManagerInterface $manager, Request $request): Response
    {
        $note = new AvoirNote();
        $apprenant = $manager->getRepository(utilisateur::class)->find($idApp);
        $matiere = $manager->getRepository(Matiere::class)->find($idMat);

        $note->setApprenants($apprenant);
        $note->setMatieres($matiere);

        $form = $this->createForm(NoteType::class, $note);
        $form-> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note =$form ->getData();
            $manager->persist($note);
            $manager->flush();
            $this -> addFlash('success', 'La note a été ajoutée');

            return $this->redirectToRoute('formateurListe'); //modifier la route par redirection login
        }
        return $this->render('formateur/ajouterNote.html.twig', [
            "form"=>$form->createView(),
            "note" => $note
        ]
        );
    }

}
<?php

namespace App\Controller;

use App\Entity\Module;
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
    #[Route('/formateur', name: 'app_formateur')]
    public function index(): Response
    {
        return $this->render('formateur/index.html.twig', [
            'controller_name' => 'FormateurController',
        ]);
    }
// recuperation de la liste des formateurs
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

    #[Route('/formateur_prog/{id}', name : 'formateur_prog')]
    public function formateur_prog(Module $module,EntityManagerInterface $manager): Response
    {
        return $this->render('formateur/prog.html.twig', [
            "module" => $module
        ]);
    }

    #[Route('/formateur_note/{id}', name: 'formateur_note')]
    public function formateur_note(Module $module,EntityManagerInterface $manager): Response
    {
        return $this->render('formateur/note.html.twig', [
            "module" => $module
        ]);
    }

    #[Route('/editProgramme/{id}', name: 'editProgramme')]
    public function editProgramme(Module $module, EntityManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(ProgrammeType::class, $module);
$id = $module->getId();
// dd($id);
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
}
<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use App\Entity\Formation;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
        public function load(ObjectManager $manager): void
        {
        // $product = new Product();
        // $manager->persist($product);

//fixture matiere
        $matiere1 = new Matiere;
        $matiere1 -> setNom('Tronc commun');
        $manager -> persist($matiere1);

        $matiere2 = new Matiere;
        $matiere2 -> setNom('Français');
        $manager -> persist($matiere2);
        $matiere3 = new Matiere;
        $matiere3 -> setNom('Math');
        $manager -> persist($matiere3);
        $matiere4 = new Matiere;
        $matiere4 -> setNom('Anglais');
        $manager -> persist($matiere4);


//fixture formation
        $formation1 = new Formation;
        $formation1 -> setNom('maintenance informatique');
        $manager -> persist($formation1);

        $formation2 = new Formation;
        $formation2 -> setNom('gestion administration');
        $manager -> persist($formation2);


//fixture Formateur
        $utilisateur1 = new Utilisateur;
        $utilisateur1 -> setNom('Martin')
                        -> setPrenom('Gabriel')
                        -> setEmail('gmartin@mail.com')
                        -> setPassword('0000')
                        // -> setRoles('');
                        -> addMatiere($matiere1)
                        -> addMatiere($matiere4);
        $manager->persist($utilisateur1);

        $utilisateur2 = new Utilisateur;
        $utilisateur2 -> setNom('Duchemin')
                        -> setPrenom('Michelle')
                        -> setEmail('mduchemin@mail.com')
                        -> setPassword('0000')
                        // -> setRoles('');
                        -> addMatiere($matiere2);
        $manager->persist($utilisateur2);
        $utilisateur3 = new Utilisateur;
        $utilisateur3 -> setNom('Gagnard')
                        -> setPrenom('Alain')
                        -> setEmail('agagnard@mail.fr')
                        -> setPassword('0000')
                        // -> setRoles('');
                        -> addMatiere($matiere3);
        $manager->persist($utilisateur3);


//fixture apprenants
        $utilisateur11 = new Utilisateur;
        $utilisateur11 -> setNom('lefèvre')
                        -> setPrenom('augustin')
                        -> setEmail('alefevre@mail.fr')
                        -> setPassword('0000');
        $manager->persist($utilisateur11);

        $utilisateur12 = new Utilisateur;
        $utilisateur12 -> setNom('Dubois')
                        -> setPrenom('Lou')
                        -> setEmail('ldubois@mail.fr')
                        -> setPassword('0000');
        $manager->persist($utilisateur12);
        $utilisateur13 = new Utilisateur;
        $utilisateur13 -> setNom('Martin')
                        -> setPrenom('Gabriel')
                        -> setEmail('gmartin@mail.fr')
                        -> setPassword('0000');
        $manager->persist($utilisateur13);
        $utilisateur14 = new Utilisateur;
        $utilisateur14 -> setNom('Fontaine')
                        -> setPrenom('juliette')
                        -> setEmail('jfontaine@mail.fr')
                        -> setPassword('0000');
        $manager->persist($utilisateur14);
        $utilisateur15 = new Utilisateur;
        $utilisateur15 -> setNom('Lopez')
                        -> setPrenom('Amelia')
                        -> setEmail('alopez@mail.fr')
                        -> setPassword('0000');
        $manager->persist($utilisateur15);






        $manager->flush();
        }
}

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



//fixture Formateur
        $utilisateur1 = new Utilisateur;
        $utilisateur1 -> setNom('Martin')
                        -> setPrenom('Gabriel')
                        -> setEmail('gmartin@mail.com')
                        -> setPassword('0000')
                        -> setRoles(['prof'])
                        -> addMatiere($matiere1)
                        -> addMatiere($matiere4);
        $manager->persist($utilisateur1);

        $utilisateur2 = new Utilisateur;
        $utilisateur2 -> setNom('Duchemin')
                        -> setPrenom('Michelle')
                        -> setEmail('mduchemin@mail.com')
                        -> setPassword('0000')
                        -> setRoles(['prof'])
                        -> addMatiere($matiere2);
        $manager->persist($utilisateur2);
        $utilisateur3 = new Utilisateur;
        $utilisateur3 -> setNom('Gagnard')
                        -> setPrenom('Alain')
                        -> setEmail('agagnard@mail.fr')
                        -> setPassword('0000')
                        -> setRoles(['prof'])
                        -> addMatiere($matiere3);
        $manager->persist($utilisateur3);


//fixture apprenants
        $utilisateur11 = new Utilisateur;
        $utilisateur11 -> setNom('lefèvre')
                        -> setPrenom('augustin')
                        -> setEmail('alefevre@mail.fr')
                        -> setRoles(['apprenant'])
                        -> setPassword('0000');
        $manager->persist($utilisateur11);

        $utilisateur12 = new Utilisateur;
        $utilisateur12 -> setNom('Dubois')
                        -> setPrenom('Lou')
                        -> setEmail('ldubois@mail.fr')
                        -> setRoles(['apprenant'])
                        -> setPassword('0000');
        $manager->persist($utilisateur12);
        $utilisateur13 = new Utilisateur;
        $utilisateur13 -> setNom('Martin')
                        -> setPrenom('Gabriel')
                        -> setEmail('gmartin@mail.fr')
                        -> setRoles(['apprenant'])
                        -> setPassword('0000');
        $manager->persist($utilisateur13);
        $utilisateur14 = new Utilisateur;
        $utilisateur14 -> setNom('Fontaine')
                        -> setPrenom('juliette')
                        -> setEmail('jfontaine@mail.fr')
                        -> setRoles(['apprenant'])
                        -> setPassword('0000');
        $manager->persist($utilisateur14);
        $utilisateur15 = new Utilisateur;
        $utilisateur15 -> setNom('Lopez')
                        -> setPrenom('Amelia')
                        -> setEmail('alopez@mail.fr')
                        -> setRoles(['apprenant'])
                        -> setPassword('0000');
        $manager->persist($utilisateur15);

//fixture tuteurs
        $utilisateur21 = new Utilisateur;
        $utilisateur21 -> setNom('Dubois')
                        -> setPrenom('Raphaël')
                        -> setEmail('rdubois@mail.fr')
                        -> setRoles(['tuteur'])
                        -> setPassword('0000')
                        -> addApprenti($utilisateur11)
                        -> addApprenti($utilisateur12)
                        -> addApprenti($utilisateur13);
                        
        $manager->persist($utilisateur21);

        $utilisateur22 = new Utilisateur;
        $utilisateur22 -> setNom('Larnis')
                        -> setPrenom('Sarah')
                        -> setEmail('slarnis@mail.fr')
                        -> setRoles(['tuteur'])
                        -> setPassword('0000');
                        // -> addApprenti($utilisateur14)
                        // -> addApprenti($utilisateur15);
        $manager->persist($utilisateur22);

//fixture formation
        $formation1 = new Formation;
        $formation1 -> setNom('maintenance informatique')
                        -> addApprenant($utilisateur11);
        $manager -> persist($formation1);

        $formation2 = new Formation;
        $formation2 -> setNom('gestion administration');
        $manager -> persist($formation2);




        $manager->flush();
        }
}

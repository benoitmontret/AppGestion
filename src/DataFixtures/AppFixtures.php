<?php

namespace App\DataFixtures;

use App\Entity\Module;
use App\Entity\Matiere;
use App\Entity\AvoirNote;
use App\Entity\Formation;
use App\Entity\Programme;
use App\Entity\FairePartie;
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
        $matiere1 -> setNom('Français');
        $manager -> persist($matiere1);
        $matiere2 = new Matiere;
        $matiere2 -> setNom('Hist-Géo');
        $manager -> persist($matiere2);
        $matiere3 = new Matiere;
        $matiere3 -> setNom('Math');
        $manager -> persist($matiere3);
        $matiere4 = new Matiere;
        $matiere4 -> setNom('Anglais');
        $manager -> persist($matiere4);

//fixture module (=matiere affecté d'un programme)
        $module1 = new Module;
        $module1 -> setMatiere($matiere1);
                // pour tester une matiere sans programme de définit
                // -> setProgramme('Programme de français de maintenance informatique');
        $manager -> persist($module1);
        $module2 = new Module;
        $module2 -> setMatiere($matiere1)
                -> setProgramme('Programme de français de gestion administration');
        $manager -> persist($module2);
        $module3 = new Module;
        $module3 -> setMatiere($matiere2)
                -> setProgramme('histoire géographie 101');
        $manager -> persist($module3);
        $module4 = new Module;
        $module4 -> setMatiere($matiere3)
                -> setProgramme('math 101');
        $manager -> persist($module4);
        $module5 = new Module;
        $module5 -> setMatiere($matiere4)
                -> setProgramme('anglais 101');
        $manager -> persist($module5);



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
        $utilisateur11 -> setNom('Lefèvre')
                        -> setPrenom('Augustin')
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
                        -> setPrenom('Juliette')
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
                        -> setPassword('0000')
                        -> addApprenti($utilisateur14)
                        -> addApprenti($utilisateur15);
        $manager->persist($utilisateur22);

//fixture formation
        $formation1 = new Formation;
        $formation1 -> setNom('Maintenance informatique')
                        -> addApprenant($utilisateur11)
                        -> addApprenant($utilisateur13)
                        -> addApprenant($utilisateur15)
                        -> addModule($module1)
                        -> addModule($module3)
                        -> addModule($module5);
        $manager -> persist($formation1);

        $formation2 = new Formation;
        $formation2 -> setNom('Gestion administration')
                        -> addApprenant($utilisateur12)
                        -> addApprenant($utilisateur14)
                        -> addModule($module2)
                        -> addModule($module4);
        $manager -> persist($formation2);

//fixture note
        $note1 = new AvoirNote;
        $note1 -> setNote('12')
                -> setApprenants($utilisateur11)
                -> setMatieres($matiere1);
        $manager -> persist($note1);
        $note2 = new AvoirNote;
        $note2 -> setNote('15')
                -> setApprenants($utilisateur11)
                -> setMatieres($matiere4);
        $manager -> persist($note2);

        $note3 = new AvoirNote;
        $note3 -> setNote('8.75')
                -> setApprenants($utilisateur12)
                -> setMatieres($matiere1);
        $manager -> persist($note3);
        $note4 = new AvoirNote;
        $note4 -> setNote('9.55')
                -> setApprenants($utilisateur12)
                -> setMatieres($matiere3);
        $manager -> persist($note4);

        $manager->flush();
        }
}

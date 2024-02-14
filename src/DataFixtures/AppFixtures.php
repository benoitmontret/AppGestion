<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // $utilisateur1 = new Utilisateur;
        // $utilisateur1 -> setNom('')
        //                 -> setPrenom('')
        //                 -> setEmail('')
        //                 -> setPassword('')
        //                 -> setRoles('')
        //                 -> ***AvoirNote('')
        //                 -> ***Formation('')
        //                 -> addMatiere('');
        
        $matiere1 = new Matiere;
        $matiere1 -> setNom('Tronc commun');
        $manager -> persist($matiere1);
            $matiere2 = new Matiere;
            $matiere2 -> setNom('Français');
            $manager -> persist($matiere2);
            $matiere3 = new Matiere;
            $matiere3 -> setNom('Math');
            $matiere4 = new Matiere;
            $matiere4 -> setNom('Anglais');
            $manager -> persist($matiere4);


                    
        $manager -> persist($matiere3);

        //fixture Formateur
        $utilisateur1 = new Utilisateur;
        $utilisateur1 -> setNom('TOTO')
                        -> setPrenom('toto')
                        -> setEmail('toto@mail.fr')
                        -> setPassword('0000')
                        // -> setRoles('');
                        -> addMatiere($matiere1)
                        -> addMatiere($matiere4);
        $manager->persist($utilisateur1);
        $utilisateur2 = new Utilisateur;
        $utilisateur2 -> setNom('TUTU')
                        -> setPrenom('tutu')
                        -> setEmail('tutu@mail.com')
                        -> setPassword('0000')
                        // -> setRoles('');
                        -> addMatiere($matiere2);
        $manager->persist($utilisateur2);
        $utilisateur3 = new Utilisateur;
        $utilisateur3 -> setNom('TITI')
                        -> setPrenom('titi')
                        -> setEmail('titi@mail.fr')
                        -> setPassword('0000')
                        // -> setRoles('');
                        -> addMatiere($matiere3);
        $manager->persist($utilisateur3);







        $manager->flush();
    }
}

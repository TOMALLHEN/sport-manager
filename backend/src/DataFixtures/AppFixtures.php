<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Joueur;
use App\Entity\Equipe;
use App\Entity\Poste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $joueur = [
            ['test', 'test_prenom', 20, 50, 60, 40, 30],
            ['tom', 'labruyere', 20, 45, 76, 23, 98],
            ['alan', 'delcuse', 19, 78, 65, 79, 30],
            ['henrdix', 'djagoue', 19, 89, 45, 76, 45],
            ['julien', 'grade', 35, 67, 87, 45, 56],
            ['maxime', 'durand', 22, 65, 72, 58, 81],
            ['nathan', 'moreau', 21, 54, 83, 67, 42],
            ['enzo', 'bernard', 24, 87, 56, 73, 64],
            ['lucas', 'petit', 26, 72, 69, 85, 53],
            ['gabriel', 'robert', 23, 61, 91, 48, 77],
        ];

        foreach ($joueur as [$nom, $prenom, $age, $vitesse, $endurance, $force, $technique ]) {
            $joueur = new Joueur();
            $joueur->setNomJoueur($nom);
            $joueur->setPrenomJoueur($prenom);
            $joueur->setAge($age);
            $joueur->setVitesse($vitesse);
            $joueur->setEndurance($endurance);
            $joueur->setForce($force);
            $joueur->setTechnique($technique);

            $manager->persist($joueur);
        }

        $equipe = [
            ['Barcelone', 'Raoul'],
            ['Real Madrid', 'Jacques'],
            ['PSG', 'François'],
        ];

        foreach ($equipe as [$nom, $coach]) {
            $equipe = new Equipe();
            $equipe->setNomEquipe($nom);
            $equipe->setCoach($coach);
            $equipe->setNiveauGlobal(0);

            $manager->persist($equipe);
        }

        $poste = [
            ['Gardien', 'Protège les buts et doit empêcher les adversaires de marquer grâce à ses réflexes et son placement.', 30, 55, 60, 75],
            ['Défenseur central', 'Protège la zone défensive, intercepte les passes et empêche les attaquants adverses de progresser.', 45, 65, 75, 55],
            ['Latéral', 'Assure la couverture défensive sur les côtés tout en participant aux phases offensives.', 75, 80, 50, 65],
            ['Milieu de terrain', 'Assure la transition entre défense et attaque, distribue le ballon et participe à la récupération.', 60, 85, 55, 85],
            ['Attaquant', 'A pour objectif de créer des occasions et de marquer des buts en exploitant les espaces adverses.', 80, 65, 65, 75],
        ];

        foreach ($poste as [$nom, $description, $vitesse, $endurance, $force, $technique]) {
            $poste = new Poste();
            $poste->setNomPoste($nom);
            $poste->setDescriptionPoste($description);
            $poste->setMinVitesse($vitesse);
            $poste->setMinEndurance($endurance);
            $poste->setMinForce($force);
            $poste->setMinTechnique($technique);

            $manager->persist($poste);
        }

        $manager->flush();
    }
}

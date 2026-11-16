<?php

namespace App\Services;

use App\Entity\Joueur;
use App\Entity\Equipe;
use App\Services\JoueurService;
use App\Services\EquipeService;
use App\Exception\JoueurPostePossedeException;
use Doctrine\ORM\EntityManagerInterface;

final class MatchService
{
    public function __construct(
        private JoueurService $joueurService,
        private EquipeService $equipeService,
        private EntityManagerInterface $entityManager
    ) {}

    public function JouerMatch(Equipe $equipe1, Equipe $equipe2): void {

        if ($this->joueurService->verifierJoueurBlesse($equipe1) || $this->joueurService->verifierJoueurBlesse($equipe2)) {
            throw new JoueurPostePossedeException("Impossible de jouer : un joueur est blessé");
        }

        if ($this->joueurService->verifierJoueurSansPoste($equipe1) || $this->joueurService->verifierJoueurSansPoste($equipe2)) {
            throw new JoueurPostePossedeException("Impossible de jouer : un joueur n'a pas de poste");
        }

        $scoreEquipe1 = random_int(1, 10);
        $scoreEquipe2 = random_int(1, 10);

        if ($scoreEquipe1 > $scoreEquipe2) {
            $resultatEquipe1 = 'victoire';
            $resultatEquipe2 = 'defaite';
            $this->mettreAJourStatistiquesEquipe($equipe1, $resultatEquipe1);
            $this->mettreAJourStatistiquesEquipe($equipe2, $resultatEquipe2);

        } elseif ($scoreEquipe1 > $scoreEquipe2) {
            $resultatEquipe1 = 'defaite';
            $resultatEquipe2 = 'victoire';
            $this->mettreAJourStatistiquesEquipe($equipe1, $resultatEquipe1);
            $this->mettreAJourStatistiquesEquipe($equipe2, $resultatEquipe2);

        } else {
            $resultatEquipe1 = 'egalite';
            $resultatEquipe2 = 'egalite';
            $this->mettreAJourStatistiquesEquipe($equipe1, $resultatEquipe1);
            $this->mettreAJourStatistiquesEquipe($equipe2, $resultatEquipe2);
        }

        $this->joueurService->attribuerPointsStats($equipe1, $resultatEquipe1);
        $this->joueurService->attribuerPointsStats($equipe2, $resultatEquipe2);
        $this->equipeService->verifierBlessures($equipe1);
        $this->joueurService->diminuerAbsence();
    }


    public function mettreAJourStatistiquesEquipe(Equipe $equipe, string $resultat): void {

        $equipe->setNbMatchs($equipe->getNbMatchs() + 1);

        if ($resultat === 'victoire') {
            $equipe->setNbVictoires($equipe->getNbVictoires() + 1);
            $equipe->setNiveauGlobal(clamp($equipe->getNiveauGlobal() +  random_int(1, 5), 0, 100));
        } elseif ($resultat === 'defaite') {
            $equipe->setNbDefaites($equipe->getNbDefaites() + 1);
            $equipe->setNiveauGlobal(clamp($equipe->getNiveauGlobal() -  random_int(1, 5), 0, 100));
        }

        $this->entityManager->flush();
    }
}

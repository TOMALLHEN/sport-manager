<?php

namespace App\Services;

use App\Entity\Joueur;
use App\Entity\Poste;
use App\Entity\Equipe;
use App\Repository\JoueurRepository;
use App\Repository\EquipeRepository;
use App\Repository\PosteRepository;
use App\Exception\JoueurIntrouvableException;
use App\Exception\EquipeIntrouvableException;
use App\Exception\JoueurMemePosteException;
use App\Exception\PosteIntrouvableException;
use App\Exception\JoueurPostePossedeException;
use App\Exception\StatistiquesInsuffisantesException;
use Doctrine\ORM\EntityManagerInterface;

final class JoueurService
{
    public function __construct(
        private JoueurRepository $joueurRepository,
        private EquipeRepository $equipeRepository,
        private PosteRepository $posteRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function affecterJoueur(int $joueurId, int $equipeId): void {
        $joueur = $this->joueurRepository->find($joueurId);

        if(!$joueur) {
            throw new JoueurIntrouvableException("Joueur introuvable");
        }

        $equipe = $this->equipeRepository->find($equipeId);

        if(!$equipe) {
            throw new EquipeIntrouvableException("Equipe introuvable");
        }

        $joueur->setEquipe($equipe);
        $this->entityManager->flush();
    }

    public function verifierStatistiquesPoste(Joueur $joueur, Poste $poste): void {

        $statistiques = [
            'Vitesse' => [$joueur->getVitesse(), $poste->getMinVitesse()],
            'Endurance' => [$joueur->getEndurance(), $poste->getMinEndurance()],
            'Force' => [$joueur->getForce(), $poste->getMinForce()],
            'Technique' => [$joueur->getTechnique(), $poste->getMinTechnique()]
        ];

        foreach ($statistiques as $nomStat => [$statJoueur, $statMin]) {
            if ($statJoueur < $statMin) {
                throw new StatistiquesInsuffisantesException("Le joueur n'a pas assez de $nomStat pour ce poste");
            }
        }
    }


    public function affecterJoueurPoste(int $joueurId, int $posteId): void {
        $joueur = $this->joueurRepository->findOneBy(['id' => $joueurId]);

        if(!$joueur) {
            throw new JoueurIntrouvableException("Joueur introuvable");
        }

        $poste = $this->posteRepository->findOneBy(['id' => $posteId]);

        if(!$poste) {
            throw new PosteIntrouvableException("Poste introuvable");
        }

        $this->verifierStatistiquesPoste($joueur, $poste);
        $joueur->setPoste($poste);
        $this->entityManager->flush();
    }


    public function swapJoueurPoste(int $joueurEchangeId, int $joueurEchangeant): void {
        $joueur1 = $this->joueurRepository->findOneBy(['id' => $joueurEchangeId]);
        $joueur2 = $this->joueurRepository->findOneBy(['id' => $joueurEchangeant]);

        if (!$joueur1 || !$joueur2) {
            throw new JoueurIntrouvableException("Un des joueurs est introuvable");
        }

        if ($joueur1->getPoste() === null || $joueur2->getPoste() === null) {
            throw new JoueurPostePossedeException("Un des deux joueurs ne possède pas de poste");
        }

        if ($joueur1->getPoste() === $joueur2->getPoste()) {
            throw new JoueurMemePosteException("Les joueurs possèdent déjà le même poste");
        }

        // récupération du poste actuel des 2 joueurs
        $poste1 = $joueur1->getPoste();
        $poste2 = $joueur2->getPoste();

        // swap de poste entre les 2 joueurs
        $joueur1->setPoste($poste2);
        $joueur2->setPoste($poste1);

        $this->entityManager->flush();
    }

    public function diminuerAbsence(): void {
        $joueurs = $this->joueurRepository->findAll();

        foreach ($joueurs as $joueur) {

            if ($joueur->getMatchAbsence() > 0) {
                $joueur->setMatchAbsence(max(0, min(4, $joueur->getMatchAbsence() - 1)));
            }

            if ($joueur->getMatchAbsence() === 0 && $joueur->isBlesse()) {
                $joueur->setBlesse(false);
                $joueur->setDateBlessure(null);
            }
        }

    $this->entityManager->flush();
}

    public function attribuerPointsStats(Equipe $equipe, string $resultat): void {
        foreach ($equipe->getJoueurs() as $joueur) {

            if ($resultat === 'egalite') {
                continue;
            }

            $vitesse = random_int(1, 3);
            $endurance = random_int(1, 3);
            $force = random_int(1, 3);
            $technique = random_int(1, 3);

            if ($resultat === 'victoire') {
                $joueur->setVitesse($joueur->getVitesse() + $vitesse);
                $joueur->setEndurance($joueur->getEndurance() + $endurance);
                $joueur->setForce($joueur->getForce() + $force);
                $joueur->setTechnique($joueur->getTechnique() + $technique);

            } elseif ($resultat === 'defaite') {
                $joueur->setVitesse(max(0, $joueur->getVitesse() - $vitesse));
                $joueur->setEndurance(max(0, $joueur->getEndurance() - $endurance));
                $joueur->setForce(max(0, $joueur->getForce() - $force));
                $joueur->setTechnique(max(0, $joueur->getTechnique() - $technique));
            }
        }

        $this->entityManager->flush();
    }

    public function verifierJoueurBlesse(Equipe $equipe): bool{

        foreach ($equipe->getJoueurs() as $joueur) {
            if ($joueur->isBlesse()) {
                return true;
            }
        }

        return false;
    }

    public function verifierJoueurSansPoste(Equipe $equipe): bool {

        foreach ($equipe->getJoueurs() as $joueur) {
            if ($joueur->getPoste() === null) {
                return true;
            }
        }

        return false;
    }
}

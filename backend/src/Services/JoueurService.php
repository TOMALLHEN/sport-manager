<?php

namespace App\Services;

use App\Repository\JoueurRepository;
use App\Repository\EquipeRepository;
use App\Repository\PosteRepository;
use Doctrine\ORM\EntityManagerInterface;

final class JoueurService
{
    public function __construct(
        private JoueurRepository $joueurRepository,
        private EquipeRepository $equipeRepository,
        private PosteRepository $posteRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function affecterJoueur($joueurId, $equipeId): void {
        $joueur = $this->joueurRepository->find($joueurId);

        if(!$joueur) {
            throw new \Exception("Joueur introuvable");
        }

        $equipe = $this->equipeRepository->find($equipeId);

        if(!$equipe) {
            throw new \Exception("Equipe introuvable");
        }

        $joueur->setEquipe($equipe);
        $this->entityManager->flush();
    }

    public function affecterJoueurPoste($joueurId, $posteId): void {
        $joueur = $this->joueurRepository->findOneBy(['id' => $joueurId]);

        if(!$joueur) {
            throw new \Exception("Joueur introuvable");
        }

        $poste = $this->posteRepository->findOneBy(['id' => $posteId]);

        if(!$poste) {
            throw new \Exception("Poste introuvable");
        }

        $joueur->setPoste($poste);
        $this->entityManager->flush();
    }

    public function swapJoueurPoste($joueurEchangeId, $joueurEchangeant): void {
        $joueur1 = $this->joueurRepository->findOneBy(['id' => $joueurEchangeId]);
        $joueur2 = $this->joueurRepository->findOneBy(['id' => $joueurEchangeant]);

        if (!$joueur1 || !$joueur2) {
            throw new \Exception("Un des joueurs est introuvable");
        }

        if ($joueur1->getPoste() === null || $joueur2->getPoste() === null) {
            throw new \Exception("Un des deux joueurs possède déjà un poste");
        }

        if ($joueur1->getPoste() === $joueur2->getPoste()) {
            throw new \Exception("Les joueurs possèdent déjà le même poste");
        }

        // récupération du poste actuel des 2 joueurs
        $poste1 = $joueur1->getPoste();
        $poste2 = $joueur2->getPoste();

        // swap de poste entre les 2 joueurs
        $joueur1->setPoste($poste2);
        $joueur2->setPoste($poste1);

        $this->entityManager->flush();

    }
}

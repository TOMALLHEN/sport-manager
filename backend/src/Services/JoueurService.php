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
}

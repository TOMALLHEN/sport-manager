<?php

namespace App\Services;

use App\Repository\JoueurRepository;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;

final class JoueurService
{
    public function __construct(
        private JoueurRepository $joueurRepository,
        private EquipeRepository $equipeRepository,
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
}

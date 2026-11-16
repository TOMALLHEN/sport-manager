<?php

namespace App\Services;

use App\Entity\Equipe;
use App\Repository\EquipeRepository;
use App\Exception\EquipeIntrouvableException;
use Doctrine\ORM\EntityManagerInterface;

final class EquipeService
{
    public function __construct(
        private EquipeRepository $equipeRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function verifierBlessures(Equipe $equipeId): void {
        $equipe = $this->equipeRepository->findOneBy(['id' => $equipeId]);

        if (!$equipe) {
            throw new EquipeIntrouvableException("Equipe introuvable");
        }

        foreach ($equipe->getJoueurs() as $joueur) {

            if ($joueur->isBlesse()) {
                continue;
            }

            $tirage = random_int(1, 100);

            if ($tirage <= 10) {
                $joueur->setBlesse(true);
                $joueur->setMatchAbsence(4);
                $joueur->setDateBlessure(new \DateTime());
            }
        }

        $this->entityManager->flush();
    }
}

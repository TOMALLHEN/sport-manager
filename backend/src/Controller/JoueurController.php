<?php

namespace App\Controller;

use App\Services\JoueurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class JoueurController extends AbstractController
{
    // Affectation d'un joueur à une équipe
    #[Route(
        '/api/joueur/{joueurId}/affecterEquipe/{equipeId}',
        name: 'affecter_joueur',
        requirements: ['joueurId' => '\d+', 'equipeId' => '\d+'],
        methods: ['POST']
    )]
    public function affectation(
        int $joueurId,
        int $equipeId,
        JoueurService $joueurService
    ): JsonResponse {

        $joueurService->affecterJoueur($joueurId, $equipeId);

        return $this->json([
            'message' => 'Joueur affecté avec succès'
        ]);
    }

    // Affectation d'un joueur à un poste
    #[Route(
        '/api/joueur/{joueurId}/affecterPoste/{posteId}',
        name: 'affecter_poste',
        requirements: ['joueurId' => '\d+', 'posteId' => '\d+'],
        methods: ['POST']
    )]
    public function affecterPoste(
        int $joueurId,
        int $posteId,
        JoueurService $joueurService
    ): JsonResponse {
        $joueurService->affecterJoueurPoste($joueurId, $posteId);

        return $this->json([
            'message' => 'Poste affecté avec succès'
        ]);
    }

    // swap de poste entre 2 joueurs
    #[Route(
        '/api/joueur/{joueurId}/swapPoste/{joueurEchangeantId}',
        name: 'swap_joueur_poste',
        requirements: ['joueurId' => '\d+', 'joueurEchangeantId' => '\d+'],
        methods: ['POST']
    )]
    public function swapPoste(
        int $joueurId,
        int $joueurEchangeantId,
        JoueurService $joueurService
    ): JsonResponse {
        $joueurService->swapJoueurPoste($joueurId, $joueurEchangeantId);

        return $this->json([
            'message' => 'Poste des joueurs échangés avec succès'
        ]);
    }
}

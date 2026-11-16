<?php

namespace App\Controller;

use App\Services\JoueurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class JoueurController extends AbstractController
{
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
}

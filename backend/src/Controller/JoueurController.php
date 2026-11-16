<?php

namespace App\Controller;

use App\Services\JoueurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class JoueurController extends AbstractController
{
    #[Route(
        '/api/joueur/{joueurId}/affecter/{equipeId}',
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
}

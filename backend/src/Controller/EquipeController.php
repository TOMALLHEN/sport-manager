<?php

namespace App\Controller;

use App\Services\EquipeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class EquipeController extends AbstractController
{

    // Calculer le pourcentage de chance qu'un joueur se blesse en fin de match
    #[Route(
        '/api/equipe/{equipeId}/verifierBlessure',
        name: 'verifier_blessure',
        requirements: ['equipeId' => '\d+'],
        methods: ['POST']
    )]
    public function verifBlessure(
        int $equipeId,
        EquipeService $equipeService
    ): JsonResponse {
        $equipeService->verifierBlessures($equipeId);

        return $this->json([
            'message' => 'Blessures mises à jour !'
        ]);
    }
}

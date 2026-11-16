<?php

namespace App\Controller;

use App\Repository\EquipeRepository;
use App\Services\MatchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class MatchController extends AbstractController
{
    public function __construct(
        private EquipeRepository $equipeRepository
    ) {}

    // Lancer un match
    #[Route(
        '/api/MatchEquipe/{equipe1_Id}/Jouer/{equipe2_Id}',
        name: 'Jouer_match',
        requirements: ['equipe1_Id' => '\d+', 'equipe2_Id' => '\d+'],
        methods: ['POST']
    )]
    public function JouerMatch(
        int $equipe1_Id,
        int $equipe2_Id,
        MatchService $matchService
    ): JsonResponse {

        $equipe1 = $this->equipeRepository->findOneBy(['id' => $equipe1_Id]);
        $equipe2 = $this->equipeRepository->findOneBy(['id' => $equipe2_Id]);

        $matchService->JouerMatch($equipe1, $equipe2);

        return $this->json([
            'message' => 'Match joué avec succès !'
        ]);
    }
}

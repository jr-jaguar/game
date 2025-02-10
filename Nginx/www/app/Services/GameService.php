<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\GameHistoryDTO;
use App\DTO\GameResultDTO;
use App\Repositories\Interfaces\GameResultRepositoryInterface;
use App\WinCalculation\WinCalculationManager;

readonly class GameService
{
    public function __construct(
        private GameResultRepositoryInterface $gameResultRepository,
        private WinCalculationManager $winCalculationManager
    ) {}

    public function play(int $playerId): GameResultDTO
    {
        $number = $this->generateRandomNumber();
        $winAmount = $this->winCalculationManager->calculateWin($number);

        $gameResultDTO = new GameResultDTO(
            randomNumber: $number,
            isWin: $winAmount > 0,
            winAmount: $winAmount,
            playerId: $playerId
        );

        $result = $this->gameResultRepository->create($gameResultDTO);

        return GameResultDTO::fromModel($result);
    }

    private function generateRandomNumber(): int
    {
        return random_int(1, 1000);
    }

    public function getLastGames(int $playerId, int $limit = 3): GameHistoryDTO
    {
        $games = $this->gameResultRepository->getLastByPlayerId($playerId, $limit);
        return GameHistoryDTO::fromModels($games);
    }
}

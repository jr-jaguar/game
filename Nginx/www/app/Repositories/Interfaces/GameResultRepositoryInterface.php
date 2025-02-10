<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\GameResultDTO;
use App\Models\GameResult;
use Illuminate\Database\Eloquent\Collection;

interface GameResultRepositoryInterface
{
    public function create(GameResultDTO $gameResultDTO): GameResult;

    public function getLastByPlayerId(int $playerId, int $limit = 3): Collection;

}

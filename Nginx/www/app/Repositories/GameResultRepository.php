<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\GameResultDTO;
use App\Models\GameResult;
use App\Repositories\Interfaces\GameResultRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class GameResultRepository implements GameResultRepositoryInterface
{
    public function create(GameResultDTO $gameResultDTO): GameResult
    {
        return GameResult::create($gameResultDTO->toArray());
    }

    public function getLastByPlayerId(int $playerId, int $limit = 3): Collection
    {
        return GameResult::query()
            ->where('player_id', $playerId)
            ->latest()
            ->limit($limit)
            ->get();
    }
}

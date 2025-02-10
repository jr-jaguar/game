<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Support\Collection;
use App\Models\GameResult;

readonly class GameHistoryDTO
{
    /**
     * @param GameResultDTO[] $games
     */
    public function __construct(
        private array $games
    ) {}

    public function toArray(): array
    {
        return array_map(
            fn (GameResultDTO $game) => $game->toArray(),
            $this->games
        );
    }

    /**
     * @param Collection<int, GameResult> $games
     */
    public static function fromModels(Collection $games): self
    {
        $gamesDTO = $games->map(
            fn (GameResult $game) => GameResultDTO::fromModel($game)
        )->all();

        return new self($gamesDTO);
    }
}

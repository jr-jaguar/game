<?php

declare(strict_types=1);

namespace App\DTO;

use App\Models\GameResult;

readonly class GameResultDTO
{
    public function __construct(
        public int $randomNumber,
        public bool $isWin,
        public float $winAmount,
        public int $playerId
    ) {}

    public static function fromModel(GameResult $result): self
    {
        return new self(
            randomNumber: $result->random_number,
            isWin: $result->is_win,
            winAmount: (float)$result->win_amount,
            playerId: $result->player_id
        );
    }

    public function toArray(): array
    {
        return [
            'random_number' => $this->randomNumber,
            'is_win' => $this->isWin,
            'win_amount' => $this->winAmount,
            'player_id' => $this->playerId
        ];
    }
}

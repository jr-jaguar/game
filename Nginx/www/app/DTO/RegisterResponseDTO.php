<?php

declare(strict_types=1);

namespace App\DTO;

readonly class RegisterResponseDTO
{
    public function __construct(
        public PlayerDTO $player,
        public LinkDTO $link,
        public string $gameUrl
    ) {}

    public static function fromResult(array $result, string $gameUrl): self
    {
        return new self(
            player: PlayerDTO::fromModel($result['player']),
            link: $result['link'],
            gameUrl: $gameUrl
        );
    }

    public function toArray(): array
    {
        return [
            'player' => $this->player->toArray(),
            'link' => $this->link->toArray(),
            'game_url' => $this->gameUrl,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\DTO;

use App\Models\AccessLink;
use Carbon\Carbon;

readonly class LinkDTO
{
    public function __construct(
        public string $token,
        public Carbon $expiresAt,
        public ?int $playerId = null
    ) {}

    public static function fromModel(AccessLink $link): self
    {
        return new self(
            token: $link->token,
            expiresAt: $link->expires_at,
            playerId: $link->player_id
        );
    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'expires_at' => $this->expiresAt,
            'player_id' => $this->playerId,
        ];
    }
}

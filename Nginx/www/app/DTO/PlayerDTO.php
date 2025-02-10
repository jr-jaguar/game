<?php

declare(strict_types=1);

namespace App\DTO;

use App\Models\Player;

readonly class PlayerDTO
{
    public function __construct(
        public string $username,
        public string $phoneNumber
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            username: $data['username'],
            phoneNumber: $data['phone_number']
        );
    }

    public static function fromModel(Player $player): self
    {
        return new self(
            username: $player->username,
            phoneNumber: $player->phone_number
        );
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'phone_number' => $this->phoneNumber,
        ];
    }
}

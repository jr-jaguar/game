<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\{PlayerDTO, RegisterResponseDTO};

readonly class RegistrationService
{
    public function __construct(
        private PlayerService $playerService,
        private LinkService $linkService
    ) {}

    public function register(PlayerDTO $playerDTO): RegisterResponseDTO
    {
        $player = $this->playerService->createPlayer($playerDTO);

        $link = $this->linkService->createLink($player->id);

        return RegisterResponseDTO::fromResult(
            result: [
                'player' => $player,
                'link' => $link
            ],
            gameUrl: route('game.show', ['token' => $link->token])
        );
    }
}

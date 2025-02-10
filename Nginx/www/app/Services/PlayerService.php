<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\PlayerDTO;
use App\Models\Player;
use App\Repositories\Interfaces\PlayerRepositoryInterface;

readonly class PlayerService
{
    public function __construct(
        private PlayerRepositoryInterface $playerRepository
    ) {}
    public function createPlayer(PlayerDTO $playerDTO): Player
    {
        return  $this->playerRepository->create($playerDTO);
    }
}

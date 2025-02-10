<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Player;
use App\DTO\PlayerDTO;
use App\Repositories\Interfaces\PlayerRepositoryInterface;
use Illuminate\Support\Collection;

readonly class PlayerRepository implements PlayerRepositoryInterface
{
    public function create(PlayerDTO $playerDTO): Player
    {
        return Player::create($playerDTO->toArray());
    }
}

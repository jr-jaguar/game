<?php

namespace App\Repositories\Interfaces;

use App\DTO\PlayerDTO;
use App\Models\Player;

interface PlayerRepositoryInterface
{
    public function create(PlayerDTO $playerDTO): Player;
}

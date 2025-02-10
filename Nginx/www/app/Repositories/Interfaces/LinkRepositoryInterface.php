<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\DTO\LinkDTO;
use App\Models\AccessLink;

interface LinkRepositoryInterface
{
    public function create(LinkDTO $linkDTO): AccessLink;

    public function update(AccessLink $link, LinkDTO $linkDTO): bool;

    public function findByToken(string $token): ?AccessLink;

    public function deactivate(AccessLink $link): bool;
}

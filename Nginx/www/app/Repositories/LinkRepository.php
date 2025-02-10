<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\LinkDTO;
use App\Models\AccessLink;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Carbon\Carbon;

readonly class LinkRepository implements LinkRepositoryInterface
{
    public function create(LinkDTO $linkDTO): AccessLink
    {
        return AccessLink::create($linkDTO->toArray());
    }

    public function update(AccessLink $link, LinkDTO $linkDTO): bool
    {
        return $link->update($linkDTO->toArray());
    }

    public function findByToken(string $token): ?AccessLink
    {
        return AccessLink::where('token', $token)->first();
    }

    public function deactivate(AccessLink $link): bool
    {
        return $link->update([
            'expires_at' => Carbon::now()->subDay()
        ]);
    }
}

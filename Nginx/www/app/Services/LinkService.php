<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\LinkDTO;
use App\Models\AccessLink;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Str;

readonly class LinkService
{
    private const EXPIRATION_DAYS = 7;

    public function __construct(
        private LinkRepositoryInterface $linkRepository
    ) {}

    public function createLink(int $playerId): LinkDTO
    {
        $linkDTO = new LinkDTO(
            token: Str::random(32),
            expiresAt: Carbon::now()->addDays(self::EXPIRATION_DAYS),
            playerId: $playerId
        );

        $link = $this->linkRepository->create($linkDTO);

        return LinkDTO::fromModel($link);
    }

    public function findByToken(string $token): ?AccessLink
    {
        return $this->linkRepository->findByToken($token);
    }

    public function deactivateLink(AccessLink $link): bool
    {
        return $this->linkRepository->deactivate($link);
    }

    public function regenerateLink(AccessLink $oldLink): LinkDTO
    {
        $this->deactivateLink($oldLink);

        return $this->createLink($oldLink->player_id);
    }

    public function isValidLink(AccessLink $link): bool
    {
        return $link && !$link->isExpired();
    }

    public function isValidToken(string $token): bool
    {
        $link = $this->findByToken($token);

        return $link && !$link->isExpired();
    }

    public function regenerateLinkByToken(string $token): LinkDTO
    {
        $link = $this->findByToken($token);

        if (!$link) {
            throw new \Exception('Link not found');
        }

        return $this->regenerateLink($link);
    }

    public function deactivateLinkByToken(string $token): void
    {
        $link = $this->findByToken($token);

        if (!$link) {
            throw new \Exception('Link not found');
        }

        $this->deactivateLink($link);
    }
}

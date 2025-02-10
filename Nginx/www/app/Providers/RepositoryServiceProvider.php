<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Interfaces\{GameResultRepositoryInterface, LinkRepositoryInterface, PlayerRepositoryInterface};
use App\Repositories\{GameResultRepository, LinkRepository, PlayerRepository};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LinkRepositoryInterface::class, LinkRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
        $this->app->bind(GameResultRepositoryInterface::class, GameResultRepository::class);
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use App\WinCalculation\WinCalculationManager;
use App\WinCalculation\Strategies\{
    HighNumberStrategy,
    MediumHighNumberStrategy,
    MediumNumberStrategy,
    LowNumberStrategy
};
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WinCalculationManager::class, function () {
            return new WinCalculationManager([
                new HighNumberStrategy(),
                new MediumHighNumberStrategy(),
                new MediumNumberStrategy(),
                new LowNumberStrategy(),
            ]);
        });
    }
}

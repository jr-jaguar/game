<?php

declare(strict_types=1);

namespace App\WinCalculation\Strategies;

use App\WinCalculation\WinCalculationStrategyInterface;

class MediumHighNumberStrategy implements WinCalculationStrategyInterface
{
    public function calculate(int $number): float
    {
        return $number * 0.5;
    }

    public function isApplicable(int $number): bool
    {
        return $number > 600 && $number <= 900;
    }
}

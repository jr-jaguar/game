<?php

declare(strict_types=1);

namespace App\WinCalculation\Strategies;

use App\WinCalculation\WinCalculationStrategyInterface;

class MediumNumberStrategy implements WinCalculationStrategyInterface
{
    public function calculate(int $number): float
    {
        return $number * 0.3;
    }

    public function isApplicable(int $number): bool
    {
        return $number > 300 && $number <= 600;
    }
}

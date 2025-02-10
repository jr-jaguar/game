<?php

declare(strict_types=1);

namespace App\WinCalculation;

use App\WinCalculation\WinCalculationStrategyInterface;

readonly class WinCalculationManager
{
    /**
     * @param WinCalculationStrategyInterface[] $strategies
     */
    public function __construct(
        private array $strategies
    ) {}

    public function calculateWin(int $number): float
    {
        if ($number % 2 !== 0) {
            return 0.0;
        }

        foreach ($this->strategies as $strategy) {
            if ($strategy->isApplicable($number)) {
                return $strategy->calculate($number);
            }
        }

        throw new \RuntimeException('No suitable strategy found for number: ' . $number);
    }
}

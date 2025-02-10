<?php

namespace App\WinCalculation;

interface WinCalculationStrategyInterface
{
    public function calculate(int $number): float;
    public function isApplicable(int $number): bool;
}

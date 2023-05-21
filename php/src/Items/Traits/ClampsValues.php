<?php

declare(strict_types=1);

namespace GildedRose\Items\Traits;

trait ClampsValues
{
    public function clamp(int $number, int $min, int $max): int
    {
        return min(max($number, $min), $max);
    }
}

<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        public array $items
    ) {
    }

    public function updateQuality(): void
    {
        // Update item quality.
        foreach ($this->items as $item) {
            if ($this->isExpired($item)) {
                if ($this->isLegendary($item)) {
                    // Legendary items do not decay.
                    continue;
                }
                if ($this->isBackStagePass($item)) {
                    // Concert tickets are worthless after the event.
                    $item->quality = 0;
                }
                // Expired items decay twice as fast.
                $item->quality -= 2;

                continue;
            }

            // Nonexpired items.
            switch ($item) {
                case $this->isAgedCheese($item):
                    $item->quality++;
                    break;
                case $this->isBackStagePass($item):
                    $item->quality++;

                    if ($item->sellIn <= 10) {
                        // Within ten days of the concert, tickets gain an additional +1 quality.
                        $item->quality++;
                    }
                    if ($item->sellIn <= 5) {
                        // Within five days of the concert, tickets gain an additional +1 quality.
                        $item->quality++;
                    }
                    break;
                case $this->isLegendary($item):
                    break;
                default:
                    $item->quality--;
                    break;
            }

            // Constrain item quality.
            if (! $this->isLegendary($item)) {
                $item->quality = $this->clamp($item->quality, 0, 50);
            }
        }

        // Update item sell-in date.
        foreach ($this->items as $item) {
            if ($this->isLegendary($item)) {
                continue;
            }

            $item->sellIn--;
        }
    }

    public function isLegendary(Item $item): bool
    {
        return str_contains($item->name, 'Sulfuras');
    }

    public function isExpired(Item $item): bool
    {
        return $item->sellIn < 0;
    }

    public function isAgedCheese(Item $item): bool
    {
        return str_contains($item->name, 'Aged Brie');
    }

    public function isBackStagePass(Item $item): bool
    {
        return str_contains($item->name, 'Backstage passes');
    }

    public function clamp(int $number, int $min, int $max): int
    {
        return min(max($min, $number), $max);
    }
}

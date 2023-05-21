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
        foreach ($this->items as $item) {
            if ($this->isLegendary($item)) {
                // Legendary items do not decay or change in quality.
                continue;
            }

            if ($this->isAgedCheese($item)) {
                $item->sellIn--;
                if ($this->isExpired($item)) {
                    $item->quality -= 2;

                    continue;
                }

                $item->quality++;

                continue;
            }

            if ($this->isBackStagePass($item)) {
                $item->sellIn--;
                if ($this->isExpired($item)) {
                    // Concert tickets are worthless after the event.
                    $item->quality = 0;

                    continue;
                }

                $item->quality++;
                if ($item->sellIn <= 10) {
                    // Within ten days of the concert, tickets gain an additional +1 quality.
                    $item->quality++;
                }
                if ($item->sellIn <= 5) {
                    // Within five days of the concert, tickets gain an additional +1 quality.
                    $item->quality++;
                }

                continue;
            }

            $item->sellIn--;
            $item->quality--;
        }

        foreach ($this->items as $item) {
            if (! $this->isLegendary($item)) {
                $item->quality = $this->clamp($item->quality, 0, 50);
            }
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

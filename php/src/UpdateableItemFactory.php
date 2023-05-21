<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedCheese;
use GildedRose\Items\BackStagePass;
use GildedRose\Items\Legendary;
use GildedRose\Items\Normal;

class UpdateableItemFactory
{
    public static function make(Item $item): UpdateableItem
    {
        switch ($item) {
            case self::isLegendary($item):
                return new Legendary($item);
            case self::isAgedCheese($item):
                return new AgedCheese($item);
            case self::isBackStagePass($item):
                return new BackStagePass($item);
            default:
                return new Normal($item);
                break;
        }
    }

    public static function isLegendary(Item $item): bool
    {
        return str_contains($item->name, 'Sulfuras');
    }

    public static function isAgedCheese(Item $item): bool
    {
        return str_contains($item->name, 'Aged Brie');
    }

    public static function isBackStagePass(Item $item): bool
    {
        return str_contains($item->name, 'Backstage passes');
    }
}

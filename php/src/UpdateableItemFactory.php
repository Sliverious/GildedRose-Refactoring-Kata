<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedCheese;
use GildedRose\Items\BackStagePass;
use GildedRose\Items\Legendary;
use GildedRose\Items\Normal;
use GildedRose\Items\Conjured;

class UpdateableItemFactory
{
    public static function make(Item $item): UpdateableItem
    {
        switch ($item) {
            case self::isLegendary($item):
                $updater = new Legendary($item);
                break;
            case self::isAgedCheese($item):
                $updater = new AgedCheese($item);
                break;
            case self::isBackStagePass($item):
                $updater = new BackStagePass($item);
                break;
            default:
                $updater = new Normal($item);
                break;
        }

        if (self::isConjured($item)) {
            return new Conjured($updater);
        }

        return $updater;
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

    public static function isConjured(Item $item): bool
    {
        return str_contains($item->name, 'Conjured');
    }
}

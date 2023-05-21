<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

trait ChecksExpiration
{
    public function isExpired(Item $item): bool
    {
        return $item->sellIn < 0;
    }
}

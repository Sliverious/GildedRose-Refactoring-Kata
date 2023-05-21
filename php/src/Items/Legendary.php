<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;
use GildedRose\UpdateableItem;

class Legendary implements UpdateableItem
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateSellInDate(): void
    {
        // Legendary items do not decay and thus do not update their sell-in date.
    }

    public function updateQuality(): void
    {
        // Legendary items do no decay and thus do not update their quality.
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}

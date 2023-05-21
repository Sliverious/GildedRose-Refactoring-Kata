<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;
use GildedRose\UpdateableItem;

class AgedCheese implements UpdateableItem
{
    use ClampsValues;
    use ChecksExpiration;

    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateSellInDate(): void
    {
        $this->item->sellIn--;
    }

    public function updateQuality(): void
    {
        if ($this->isExpired($this->item)) {
            $this->item->quality -= 2;
        } else {
            $this->item->quality++;
        }

        $this->item->quality = $this->clamp($this->item->quality, 0, 50);
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}

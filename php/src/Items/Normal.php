<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;
use GildedRose\Items\Traits\ChecksExpiration;
use GildedRose\Items\Traits\ClampsValues;
use GildedRose\UpdateableItem;

class Normal implements UpdateableItem
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
        $this->item->quality--;
        if ($this->isExpired($this->item)) {
            // Perished items decay twice as fast.
            $this->item->quality--;
        }

        $this->item->quality = $this->clamp($this->item->quality, 0, 50);
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}

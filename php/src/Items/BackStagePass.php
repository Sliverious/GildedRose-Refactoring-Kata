<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;
use GildedRose\Items\Traits\ChecksExpiration;
use GildedRose\Items\Traits\ClampsValues;
use GildedRose\UpdateableItem;

class BackStagePass implements UpdateableItem
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
            // Concert tickets are worthless after the event.
            $this->item->quality = 0;

            return;
        }

        $this->item->quality++;
        if ($this->item->sellIn <= 10) {
            // Within ten days of the concert, tickets gain an additional +1 quality.
            $this->item->quality++;
        }
        if ($this->item->sellIn <= 5) {
            // Within five days of the concert, tickets gain an additional +1 quality.
            $this->item->quality++;
        }

        $this->item->quality = $this->clamp($this->item->quality, 0, 50);
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}

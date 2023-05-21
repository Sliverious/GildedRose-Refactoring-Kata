<?php

namespace GildedRose\Items;

use GildedRose\Item;
use GildedRose\UpdateableItem;

class Conjured implements UpdateableItem
{
    private UpdateableItem $item;
    private int $startingQuality = 0;

    public function __construct(UpdateableItem $item)
    {
        $this->item = $item;
        $this->startingQuality = $this->item->getItem()->quality;
    }

    public function updateSellInDate(): void
    {
        $this->item->updateSellInDate();
    }

    public function updateQuality(): void
    {
        $this->item->updateQuality();
    }

    public function getItem(): Item
    {
        $updatedItem = $this->item->getItem();
        $qualityDifference = $this->startingQuality - $updatedItem->quality;

        // The item decreased in quality.
        if ($qualityDifference > 0) {
            // Conjured items decay twice as fast.
           $updatedItem->quality -= $qualityDifference; 
        }

        return $updatedItem;
    }
}

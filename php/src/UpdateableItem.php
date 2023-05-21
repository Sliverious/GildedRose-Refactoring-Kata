<?php

declare(strict_types=1);

namespace GildedRose;

interface UpdateableItem
{
    public function updateSellInDate(): void;

    public function updateQuality(): void;

    // Used to retrieve the item after updating.
    public function getItem(): Item;
}

<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\UpdateableItemFactory;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        public array $items
    ) {
    }

    public function updateStock(): void
    {
        array_map(
            function (Item $item): Item {
                $updater = UpdateableItemFactory::make($item);
                $updater->updateSellInDate();
                $updater->updateQuality();

                return $updater->getItem();
            },
            $this->items
        );
    }
}

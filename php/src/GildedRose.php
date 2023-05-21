<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        public array $items
    ) {
    }

    public function updateQuality(): void
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

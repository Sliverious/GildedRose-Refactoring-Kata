<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /** 
     * @dataProvider itemsProvider
     * @test
     */
    public function it_updates_stock_as_expected(Item $item, Item $expectedItem): void
    {
        $app = new GildedRose([$item]);

        $app->updateQuality();        

        $updatedItem = $app->items[0];

        $this->assertEquals($expectedItem->name, $updatedItem->name);
        $this->assertEquals($expectedItem->sellIn, $updatedItem->sellIn);
        $this->assertEquals($expectedItem->quality, $updatedItem->quality);
    }

    public function itemsProvider(): array
    {
        return [
            [new Item('+5 Dexterity Vest', 10, 20), new Item('+5 Dexterity Vest', 9, 19)],
            [new Item('Aged Brie', 2, 0), new Item('Aged Brie', 1, 1)],
            [new Item('Elixir of the Mongoose', 5, 7), new Item('Elixir of the Mongoose', 4, 6)],
            [new Item('Sulfuras, Hand of Ragnaros', 0, 80), new Item('Sulfuras, Hand of Ragnaros', 0, 80)],
            [new Item('Sulfuras, Hand of Ragnaros', -1, 80), new Item('Sulfuras, Hand of Ragnaros', -1, 80)],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20), new Item('Backstage passes to a TAFKAL80ETC concert', 14, 21)],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49), new Item('Backstage passes to a TAFKAL80ETC concert', 9, 50)],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49), new Item('Backstage passes to a TAFKAL80ETC concert', 4, 50)],
            [new Item('Conjured Mana Cake', 3, 6), new Item('Conjured Mana Cake', 2, 5)],
        ];
    }
}

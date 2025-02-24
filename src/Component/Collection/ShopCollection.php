<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Collection;

use SergeyZatulivetrov\TinkoffAcquiring\Component\Shop;

/**
 * ShopCollection
 *
 * @phpstan-import-type T from Shop
 * @phpstan-extends AbstractCollection<T,Shop>
 */
class ShopCollection extends AbstractCollection
{
    public static function factory(array $data = []): self
    {
        $collection = new ShopCollection();

        foreach ($data as $item) {
            $collection->add(Shop::factory($item));
        }

        return $collection;
    }
}

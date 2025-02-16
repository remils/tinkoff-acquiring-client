<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Collection;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Shop;

/**
 * ShopCollection
 *
 * @phpstan-import-type TData from Shop
 */
class ShopCollection
{
    /**
     * @var array<Shop>
     */
    protected array $items = [];

    public static function new(): self
    {
        return new self();
    }

    public function add(Shop $shop): self
    {
        $this->items[] = $shop;

        return $this;
    }

    /**
     * @return TData[]
     */
    public function toArray(): array
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = $item->toArray();
        }

        return $items;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Collection;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\ReceiptItem;

/**
 * ReceiptCollection
 *
 * @phpstan-import-type TData from ReceiptItem
 */
class ReceiptCollection
{
    /**
     * @var array<ReceiptItem>
     */
    protected array $items = [];

    public static function new(): self
    {
        return new self();
    }

    public function add(ReceiptItem $receipt): self
    {
        $this->items[] = $receipt;

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

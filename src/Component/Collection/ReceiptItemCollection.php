<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Collection;

use SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt\ReceiptItem;

/**
 * ReceiptItemCollection
 *
 * @phpstan-import-type T from ReceiptItem
 * @phpstan-extends AbstractCollection<T,ReceiptItem>
 */
class ReceiptItemCollection extends AbstractCollection
{
    public static function factory(array $data = []): self
    {
        $collection = new ReceiptItemCollection();

        foreach ($data as $item) {
            $collection->add(ReceiptItem::factory($item));
        }

        return $collection;
    }
}

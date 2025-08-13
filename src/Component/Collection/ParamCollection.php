<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Collection;

use SergeyZatulivetrov\TinkoffAcquiring\Component\Param;

/**
 * ParamCollection
 *
 * @phpstan-import-type T from Param
 * @phpstan-extends AbstractCollection<T,Param>
 */
class ParamCollection extends AbstractCollection
{
    public static function factory(array $data = []): self
    {
        $collection = new ParamCollection();

        foreach ($data as $item) {
            $collection->add(Param::factory($item));
        }

        return $collection;
    }
}

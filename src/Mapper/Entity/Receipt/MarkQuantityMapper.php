<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\MarkQuantity;

/**
 * MarkQuantityMapper
 *
 * @phpstan-type TItem array{
 *      Numerator: int,
 *      Denominator: int
 * }
 */
class MarkQuantityMapper
{
    /**
     * @param MarkQuantity $entity
     * @return TItem
     */
    public function item(MarkQuantity $entity)
    {
        return [
            'Numerator' => $entity->numerator,
            'Denominator' => $entity->denominator,
        ];
    }
}

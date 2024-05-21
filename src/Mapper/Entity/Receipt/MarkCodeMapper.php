<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\MarkCode;

/**
 * MarkCodeMapper
 *
 * @phpstan-type TItem array{
 *      MarkCodeType: string,
 *      Value: string
 * }
 */
class MarkCodeMapper
{
    /**
     * @param MarkCode $entity
     * @return TItem
     */
    public function item(MarkCode $entity)
    {
        return [
            'MarkCodeType' => $entity->markCodeType,
            'Value' => $entity->value,
        ];
    }
}

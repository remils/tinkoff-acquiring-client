<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\SectoralItemProps;

/**
 * SectoralItemPropsMapper
 *
 * @phpstan-type TItem array{
 *      FederalId: string,
 *      Date: string,
 *      Number: string,
 *      Value: string
 * }
 */
class SectoralItemPropsMapper
{
    /**
     * @param SectoralItemProps $entity
     * @return TItem
     */
    public function item(SectoralItemProps $entity)
    {
        return [
            'FederalId' => $entity->federalId,
            'Date' => $entity->date,
            'Number' => $entity->number,
            'Value' => $entity->value,
        ];
    }
}

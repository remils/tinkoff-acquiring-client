<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\SupplierInfo;

/**
 * SupplierInfoMapper
 *
 * @phpstan-type TItem array{
 *      Phones: string[]|null,
 *      Name: string|null,
 *      Inn: string|null
 * }
 */
class SupplierInfoMapper
{
    /**
     * @param SupplierInfo $entity
     * @return TItem
     */
    public function item(SupplierInfo $entity)
    {
        /**
         * @var TItem $data
         */
        $data = [];

        if (null !== $entity->phones) {
            $data['Phones'] = $entity->phones;
        }

        if (null !== $entity->name) {
            $data['Name'] = $entity->name;
        }

        if (null !== $entity->inn) {
            $data['Inn'] = $entity->inn;
        }

        return $data;
    }
}

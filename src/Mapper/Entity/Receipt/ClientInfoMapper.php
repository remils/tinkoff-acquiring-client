<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\ClientInfo;

/**
 * ClientInfoMapper
 *
 * @phpstan-type TItem array{
 *      Address: string|null,
 *      Birthdate: string|null,
 *      Citizenship: string|null,
 *      DocumentCode: string|null,
 *      DocumentData: string|null
 * }
 */
class ClientInfoMapper
{
    /**
     * @param ClientInfo $entity
     * @return TItem
     */
    public function item(ClientInfo $entity)
    {
        /**
         * @var TItem $data
         */
        $data = [];

        if (null !== $entity->address) {
            $data['Address'] = $entity->address;
        }

        if (null !== $entity->birthdate) {
            $data['Birthdate'] = $entity->birthdate;
        }

        if (null !== $entity->citizenship) {
            $data['Citizenship'] = $entity->citizenship;
        }

        if (null !== $entity->documentCode) {
            $data['DocumentCode'] = $entity->documentCode;
        }

        if (null !== $entity->documentData) {
            $data['DocumentData'] = $entity->documentData;
        }

        return $data;
    }
}

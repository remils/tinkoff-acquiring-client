<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\Payments;

/**
 * PaymentsMapper
 *
 * @phpstan-type TItem array{
 *      Electronic: int,
 *      Provision: int|null,
 *      Credit: int|null,
 *      Cash: int|null,
 *      AdvancePayment: int|null
 * }
 */
class PaymentsMapper
{
    /**
     * @param Payments $entity
     * @return TItem
     */
    public function item(Payments $entity)
    {
        /**
         * @var TItem $data
         */
        $data = [
            'Electronic' => $entity->electronic,
        ];

        if (null !== $entity->provision) {
            $data['Provision'] = $entity->provision;
        }

        if (null !== $entity->credit) {
            $data['Credit'] = $entity->credit;
        }

        if (null !== $entity->cash) {
            $data['Cash'] = $entity->cash;
        }

        if (null !== $entity->advancePayment) {
            $data['AdvancePayment'] = $entity->advancePayment;
        }

        return $data;
    }
}

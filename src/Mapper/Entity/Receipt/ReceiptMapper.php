<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\Receipt;

/**
 * ReceiptMapper
 *
 * @phpstan-import-type TItem from ReceiptItemMapper as TReceiptItem
 * @phpstan-import-type TItem from ClientInfoMapper as TClientInfo
 * @phpstan-import-type TItem from PaymentsMapper as TPayments
 *
 * @phpstan-type TItem array{
 *      Taxation: string,
 *      Items: TReceiptItem[],
 *      FfdVersion: string|null,
 *      Email: string|null,
 *      Phone: string|null,
 *      Customer: string|null,
 *      CustomerInn: string|null,
 *      Payments: TPayments|null,
 *      ClientInfo: TClientInfo|null
 * }
 */
class ReceiptMapper
{
    public function __construct(
        protected readonly ReceiptItemMapper $receiptItemMapper,
        protected readonly ClientInfoMapper $clientInfoMapper,
        protected readonly PaymentsMapper $paymentsMapper,
    ) {
    }

    /**
     * @param Receipt $entity
     * @return TItem
     */
    public function item(Receipt $entity)
    {
        /**
         * @var TItem $data
         */
        $data = [
            'Taxation' => $entity->taxation->value,
            'Items' => array_map($this->receiptItemMapper->item(...), $entity->items),
        ];

        if (null !== $entity->ffdVersion) {
            $data['FfdVersion'] = $entity->ffdVersion;
        }

        if (null !== $entity->email) {
            $data['Email'] = $entity->email;
        }

        if (null !== $entity->phone) {
            $data['Phone'] = $entity->phone;
        }

        if (null !== $entity->payments) {
            $data['Payments'] = $this->paymentsMapper->item($entity->payments);
        }

        if (null !== $entity->customer) {
            $data['Customer'] = $entity->customer;
        }

        if (null !== $entity->customerInn) {
            $data['CustomerInn'] = $entity->customerInn;
        }

        if (null !== $entity->clientInfo) {
            $data['ClientInfo'] = $this->clientInfoMapper->item($entity->clientInfo);
        }

        return $data;
    }
}

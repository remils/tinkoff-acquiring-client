<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\TaxationEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Collection;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Collection\ReceiptItemCollection;

/**
 * Receipt
 *
 * @phpstan-import-type T from ReceiptItem as TReceiptItem
 * @phpstan-import-type T from Payments as TPayments
 * @phpstan-import-type T from ClientInfo as TClientInfo
 *
 * @phpstan-type T array{
 *      Taxation:    string,
 *      Items:       TReceiptItem[],
 *      FfdVersion:  ?string,
 *      Email:       ?string,
 *      Phone:       ?string,
 *      Customer:    ?string,
 *      CustomerInn: ?string,
 *      Payments:    ?TPayments,
 *      ClientInfo:  ?TClientInfo
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class Receipt implements ComponentInterface
{
    /**
     * @param TaxationEnum          $taxation    Система налогообложения
     * @param ReceiptItemCollection $items       Массив позиций чека с информацией о товарах
     * @param ?string               $ffdVersion  Версия ФФД. Возможные значения: 1.2, 1.05
     * @phpcs:ignore
     * @param ?string               $email       Электронная почта клиента. Должен быть заполнен, если не передан телефон
     * @phpcs:ignore
     * @param ?string               $phone       Телефон клиента в формате +{Ц}. Должен быть заполнен, если не передана почта
     * @param ?Payments             $payments    Детали платежа
     * @param ?string               $customer    Идентификатор/Имя клиента
     * @param ?string               $customerInn ИНН клиента
     * @param ?ClientInfo           $clientInfo  Информация по клиенту
     */
    public function __construct(
        public readonly TaxationEnum $taxation,
        public readonly ReceiptItemCollection $items,
        public readonly ?string $ffdVersion = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?Payments $payments = null,
        public readonly ?string $customer = null,
        public readonly ?string $customerInn = null,
        public readonly ?ClientInfo $clientInfo = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new Receipt(
            taxation:    TaxationEnum::from($data['Taxation']),
            items:       ReceiptItemCollection::factory($data['Items']),
            ffdVersion:  $data['FfdVersion'] ?? null,
            email:       $data['Email'] ?? null,
            phone:       $data['Phone'] ?? null,
            payments:    empty($data['Payments']) ? null : Payments::factory($data['Payments']),
            customer:    $data['Customer'],
            customerInn: $data['CustomerInn'],
            clientInfo:  empty($data['ClientInfo']) ? null : ClientInfo::factory($data['ClientInfo']),
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['Taxation'] = $this->taxation->value;
        $data['Items'] = $this->items->toArray();

        if (null !== $this->ffdVersion) {
            $data['FfdVersion'] = $this->ffdVersion;
        }

        if (null !== $this->email) {
            $data['Email'] = $this->email;
        }

        if (null !== $this->phone) {
            $data['Phone'] = $this->phone;
        }

        if (null !== $this->payments) {
            $data['Payments'] = $this->payments->toArray();
        }

        if (null !== $this->customer) {
            $data['Customer'] = $this->customer;
        }

        if (null !== $this->customerInn) {
            $data['CustomerInn'] = $this->customerInn;
        }

        if (null !== $this->clientInfo) {
            $data['ClientInfo'] = $this->clientInfo->toArray();
        }

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\TaxationEnum;

/**
 * Receipt
 */
class Receipt
{
    /**
     * @param TaxationEnum $taxation Система налогообложения
     * @param ReceiptItem[] $items Массив позиций чека с информацией о товарах
     * @param string|null $ffdVersion Версия ФФД. Возможные значения:
     * - 1.2
     * - 1.05
     * @param string|null $email Электронная почта клиента. Должен быть заполнен, если не передан телефон
     * @param string|null $phone Телефон клиента в формате +{Ц}. Должен быть заполнен, если не передана почта
     * @param Payments|null $payments Детали платежа. Если объект не передан, будет автоматически указана
     * итоговая сумма чека с видом оплаты "Безналичный". Если передан объект receipt.Payments, то значение
     * в Electronic должно быть равно итоговому значению Amount в методе Init. При этом сумма введенных значений
     * по всем видам оплат, включая Electronic, должна быть равна сумме (Amount) всех товаров, переданных
     * в объекте receipt.Items.
     * @param string|null $customer Идентификатор/Имя клиента
     * @param string|null $customerInn ИНН клиента
     * @param ClientInfo|null $clientInfo Информация по клиенту. Обязателен для товаров с маркировкой.
     */
    public function __construct(
        public readonly TaxationEnum $taxation,
        public readonly array $items,
        public readonly ?string $ffdVersion = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?Payments $payments = null,
        public readonly ?string $customer = null,
        public readonly ?string $customerInn = null,
        public readonly ?ClientInfo $clientInfo = null,
    ) {
    }
}

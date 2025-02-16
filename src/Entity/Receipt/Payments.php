<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

/**
 * Payments
 *
 * @phpstan-type TData array{
 *      Electronic: int,
 *      Provision: int|null,
 *      Credit: int|null,
 *      Cash: int|null,
 *      AdvancePayment: int|null
 * }
 */
class Payments
{
    /**
     * @param int $electronic Вид оплаты "Безналичный"
     * @param int|null $cash Вид оплаты "Наличные". Сумма к оплате в копейках
     * @param int|null $advancePayment Вид оплаты "Предварительная оплата (Аванс)"
     * @param int|null $credit Вид оплаты "Постоплата (Кредит)"
     * @param int|null $provision Вид оплаты "Иная форма оплаты"
     */
    public function __construct(
        public readonly int $electronic,
        public readonly ?int $cash = null,
        public readonly ?int $advancePayment = null,
        public readonly ?int $credit = null,
        public readonly ?int $provision = null,
    ) {
    }

    /**
     * @return TData
     */
    public function toArray(): array
    {
        /**
         * @var TData $data
         */
        $data = [
            'Electronic' => $this->electronic,
        ];

        if (null !== $this->provision) {
            $data['Provision'] = $this->provision;
        }

        if (null !== $this->credit) {
            $data['Credit'] = $this->credit;
        }

        if (null !== $this->cash) {
            $data['Cash'] = $this->cash;
        }

        if (null !== $this->advancePayment) {
            $data['AdvancePayment'] = $this->advancePayment;
        }

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * Payments
 *
 * @phpstan-type T array{
 *      Electronic:     int,
 *      Provision:      ?int,
 *      Credit:         ?int,
 *      Cash:           ?int,
 *      AdvancePayment: ?int
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class Payments implements ComponentInterface
{
    /**
     * @param int  $electronic     Вид оплаты "Безналичный"
     * @param ?int $cash           Вид оплаты "Наличные". Сумма к оплате в копейках
     * @param ?int $advancePayment Вид оплаты "Предварительная оплата (Аванс)"
     * @param ?int $credit         Вид оплаты "Постоплата (Кредит)"
     * @param ?int $provision      Вид оплаты "Иная форма оплаты"
     */
    public function __construct(
        public readonly int $electronic,
        public readonly ?int $cash = null,
        public readonly ?int $advancePayment = null,
        public readonly ?int $credit = null,
        public readonly ?int $provision = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new Payments(
            electronic: $data['Electronic'],
            cash: $data['Cash'] ?? null,
            advancePayment: $data['AdvancePayment'] ?? null,
            credit: $data['Credit'] ?? null,
            provision: $data['Provision'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['Electronic'] = $this->electronic;

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

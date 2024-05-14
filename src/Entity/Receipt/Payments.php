<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

/**
 * Payments
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
}

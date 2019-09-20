<?php

declare(strict_types=1);

/**
 * Признак способа расчёта. Если значение не передано, по умолчанию в онлайн-кассу передается признак способа расчёта "full_payment".
 * Возможные значения:
 * full_prepayment – предоплата 100%.
 * prepayment – предоплата.
 * advance – аванс.
 * full_payment – полный расчет.
 * partial_payment – частичный расчет и кредит.
 * credit – передача в кредит.
 * credit_payment – оплата кредита.
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait PaymentMethod
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait PaymentMethod
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $paymentMethod
     *
     * @return $this
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->data['PaymentMethod'] = $paymentMethod;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->data['PaymentMethod'];
    }

    /**
     * @return $this
     */
    public function removePaymentMethod()
    {
        unset($this->data['PaymentMethod']);

        return $this;
    }
}
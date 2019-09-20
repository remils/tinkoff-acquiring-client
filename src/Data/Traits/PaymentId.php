<?php

declare(strict_types=1);

/**
 * Уникальный идентификатор транзакции в системе Банка
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait PaymentId
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait PaymentId
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $paymentId
     *
     * @return $this
     */
    public function setPaymentId($paymentId)
    {
        $this->data['PaymentId'] = $paymentId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->data['PaymentId'];
    }

    /**
     * @return $this
     */
    public function removePaymentId()
    {
        unset($this->data['PaymentId']);

        return $this;
    }
}
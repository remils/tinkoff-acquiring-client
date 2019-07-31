<?php

/**
 * Определяет тип проведения платежа - двухстадийная или одностадийная оплата.
 * "О" - одностадийная оплата;
 * "T"- двухстадийная оплата
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait PayType
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait PayType
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $payType
     *
     * @return $this
     */
    public function setPayType($payType)
    {
        $this->data['PayType'] = $payType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayType()
    {
        return $this->data['PayType'];
    }

    /**
     * @return $this
     */
    public function removePayType()
    {
        unset($this->data['PayType']);

        return $this;
    }
}
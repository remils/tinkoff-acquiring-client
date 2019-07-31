<?php

/**
 * Сумма в копейках.
 * Параметр "Amount" должен быть равен сумме всех параметров "Amount", переданных в объекте Items.
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Amount
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Amount
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->data['Amount'] = $amount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->data['Amount'];
    }

    /**
     * @return $this
     */
    public function removeAmount()
    {
        unset($this->data['Amount']);

        return $this;
    }
}
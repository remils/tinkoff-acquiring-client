<?php

declare(strict_types=1);

/**
 * Номер заказа в системе Продавца
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait OrderId
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait OrderId
{
    /**
     * @var array 
     */
    private $data = [];

    /**
     * @param $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->data['OrderId'] = $orderId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->data['OrderId'];
    }

    /**
     * @return $this
     */
    public function removeOrderId()
    {
        unset($this->data['OrderId']);

        return $this;
    }
}
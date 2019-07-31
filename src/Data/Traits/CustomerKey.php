<?php

/**
 * Идентификатор покупателя в системе Продавца. Если передается, для данного
 * покупателя будет осуществлена привязка карты к данному идентификатору клиента
 * CustomerKey. В нотификации на AUTHORIZED будет передан параметр CardId,
 * подробнее см. метод GetGardList. Параметр обязателен, если Recurrent = Y
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait CustomerKey
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait CustomerKey
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $customerKey
     *
     * @return $this
     */
    public function setCustomerKey($customerKey)
    {
        $this->data['CustomerKey'] = $customerKey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerKey()
    {
        return $this->data['CustomerKey'];
    }

    /**
     * @return $this
     */
    public function removeCustomerKey()
    {
        unset($this->data['CustomerKey']);

        return $this;
    }
}
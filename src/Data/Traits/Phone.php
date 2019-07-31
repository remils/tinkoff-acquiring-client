<?php

/**
 * Телефон покупателя. Поле обязательно, если не передан параметр Email
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Phone
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Phone
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->data['Phone'] = $phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->data['Phone'];
    }

    /**
     * @return $this
     */
    public function removePhone()
    {
        unset($this->data['Phone']);

        return $this;
    }
}
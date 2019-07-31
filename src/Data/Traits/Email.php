<?php

/**
 * Электронный адрес для отправки чека покупателю. Поле обязательно, если не передан параметр Phone
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Email
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Email
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->data['Email'] = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->data['Email'];
    }

    /**
     * @return $this
     */
    public function removeEmail()
    {
        unset($this->data['Email']);

        return $this;
    }
}
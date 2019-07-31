<?php

/**
 * Электронная почта отправителя чека. Максимальная длина строки – 64 символа
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait EmailCompany
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait EmailCompany
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $emailCompany
     *
     * @return $this
     */
    public function setEmailCompany($emailCompany)
    {
        $this->data['EmailCompany'] = $emailCompany;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailCompany()
    {
        return $this->data['EmailCompany'];
    }

    /**
     * @return $this
     */
    public function removeEmailCompany()
    {
        unset($this->data['EmailCompany']);

        return $this;
    }
}
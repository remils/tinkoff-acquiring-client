<?php

/**
 * IP-адрес клиента
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait IP
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait IP
{
    /**
     * @var array 
     */
    private $data = [];

    /**
     * @param $ip
     *
     * @return $this
     */
    public function setIP($ip)
    {
        $this->data['IP'] = $ip;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIP()
    {
        return $this->data['IP'];
    }

    /**
     * @return $this
     */
    public function removeIP()
    {
        unset($this->data['IP']);

        return $this;
    }
}
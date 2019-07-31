<?php

/**
 * Подпись запроса. Алгоритм формирования подписи описан в разделе
 * "Подпись запросов"
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Token
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Token
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->data['Token'] = $token;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->data['Token'];
    }

    /**
     * @return $this
     */
    public function removeToken()
    {
        unset($this->data['Token']);

        return $this;
    }
}
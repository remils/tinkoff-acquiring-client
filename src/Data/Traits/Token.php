<?php

declare(strict_types=1);

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
     * @param $password
     *
     * @return $this
     */
    public function setToken($password)
    {
        $data             = $this->data;
        unset($data['Receipt'], $data['DATA']);
        $data['Password'] = $password;
        ksort($data);

        $token            = '';
        foreach ($data as $value) {
            $token .= $value;
        }

        $this->data['Token'] = hash('sha256', $token);

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
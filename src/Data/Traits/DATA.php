<?php

declare(strict_types=1);

/**
 * JSON объект, содержащий дополнительные параметры в виде “ключ”:”значение”. Данные параметры
 * будут переданы на страницу оплаты (в случае ее кастомизации). Максимальная длина для каждого
 * передаваемого параметра:
 * Ключ – 20 знаков,
 * Значение – 100 знаков.
 * Максимальное количество пар «ключ-значение» не может превышать 20
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait DATA
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait DATA
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $data
     *
     * @return $this
     */
    public function setDATA($data)
    {
        $this->data['DATA'] = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDATA()
    {
        return $this->data['DATA'];
    }

    /**
     * @return $this
     */
    public function removeDATA()
    {
        unset($this->data['DATA']);

        return $this;
    }
}
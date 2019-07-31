<?php

/**
 * Цена в копейках. *Целочисленное значение не более 10 знаков
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Price
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Price
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->data['Price'] = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->data['Price'];
    }

    /**
     * @return $this
     */
    public function removePrice()
    {
        unset($this->data['Price']);

        return $this;
    }
}
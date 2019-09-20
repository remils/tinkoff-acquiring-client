<?php

declare(strict_types=1);

/**
 * Количество/вес:
 * целая часть не более 8 знаков;
 * дробная часть не более 3 знаков
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Quantity
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Quantity
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->data['Quantity'] = $quantity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->data['Quantity'];
    }

    /**
     * @return $this
     */
    public function removeQuantity()
    {
        unset($this->data['Quantity']);

        return $this;
    }
}
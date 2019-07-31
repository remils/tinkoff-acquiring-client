<?php

/**
 * Массив, содержащий в себе информацию о товарах
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Items
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Items
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->data['Items'] = $items;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->data['Items'];
    }

    /**
     * @return $this
     */
    public function removeItems()
    {
        unset($this->data['Items']);

        return $this;
    }
}
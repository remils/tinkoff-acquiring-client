<?php

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait BaseData
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data
 */
trait BaseData
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @return array
     */
    public function get()
    {
        return $this->data;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->data = [];

        return $this;
    }
}
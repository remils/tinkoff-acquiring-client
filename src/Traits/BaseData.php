<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Traits;

/**
 * Trait BaseData
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
    public function toArray()
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

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[ $name ] = $value;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[ $name ];
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        if (isset($this->data[ $name ])) {
            unset($this->data[ $name ]);
        }
    }
}
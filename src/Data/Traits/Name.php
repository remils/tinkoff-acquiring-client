<?php

/**
 * Наименование товара. Максимальная длина строки – 128 символа
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Name
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Name
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->data['Name'] = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->data['Name'];
    }

    /**
     * @return $this
     */
    public function removeName()
    {
        unset($this->data['Name']);

        return $this;
    }
}
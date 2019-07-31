<?php

/**
 * Краткое описание
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Description
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Description
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->data['Description'] = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->data['Description'];
    }

    /**
     * @return $this
     */
    public function removeDescription()
    {
        unset($this->data['Description']);

        return $this;
    }
}
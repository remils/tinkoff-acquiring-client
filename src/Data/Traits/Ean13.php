<?php

declare(strict_types=1);

/**
 * Штрих-код
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Ean13
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Ean13
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $ean13
     *
     * @return $this
     */
    public function setEan13($ean13)
    {
        $this->data['Ean13'] = $ean13;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEan13()
    {
        return $this->data['Ean13'];
    }

    /**
     * @return $this
     */
    public function removeEan13()
    {
        unset($this->data['Ean13']);

        return $this;
    }
}
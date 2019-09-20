<?php

declare(strict_types=1);

/**
 * JSON объект с данными чека
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Receipt
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Receipt
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $receipt
     *
     * @return $this
     */
    public function setReceipt($receipt)
    {
        $this->data['Receipt'] = $receipt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceipt()
    {
        return $this->data['Receipt'];
    }

    /**
     * @return $this
     */
    public function removeReceipt()
    {
        unset($this->data['Receipt']);

        return $this;
    }
}
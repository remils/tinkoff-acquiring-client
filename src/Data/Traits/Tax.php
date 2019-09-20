<?php

declare(strict_types=1);

/**
 * Ставка налога. Перечисление со значениями:
 * «none» – без НДС;
 * «vat0» – НДС по ставке 0%;
 * «vat10» – НДС чека по ставке 10%;
 * «vat20» – НДС чека по ставке 20%;
 * «vat110» – НДС чека по расчетной ставке 10/110;
 * «vat120» – НДС чека по расчетной ставке 20/120
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Tax
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Tax
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $tax
     *
     * @return $this
     */
    public function setTax($tax)
    {
        $this->data['Tax'] = $tax;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->data['Tax'];
    }

    /**
     * @return $this
     */
    public function removeTax()
    {
        unset($this->data['Tax']);

        return $this;
    }
}
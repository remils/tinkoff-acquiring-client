<?php

/**
 * Система налогообложения. Перечисление со значениями:
 * «osn» – общая СН;
 * «usn_income» – упрощенная СН (доходы);
 * «usn_income_outcome» – упрощенная СН (доходы минус расходы);
 * «envd» – единый налог на вмененный доход;
 * «esn» – единый сельскохозяйственный налог;
 * «patent» – патентная СН
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Taxation
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Taxation
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $taxation
     *
     * @return $this
     */
    public function setTaxation($taxation)
    {
        $this->data['Taxation'] = $taxation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxation()
    {
        return $this->data['Taxation'];
    }

    /**
     * @return $this
     */
    public function removeTaxation()
    {
        unset($this->data['Taxation']);

        return $this;
    }
}
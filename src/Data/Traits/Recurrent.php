<?php

declare(strict_types=1);

/**
 * Если передается и установлен в Y, регистрирует платёж как рекуррентный. В этом
 * случае после оплаты в нотификации на AUTHORIZED будет передан параметр RebillId
 * для использования в методе Charge
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Recurrent
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Recurrent
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $recurrent
     *
     * @return $this
     */
    public function setRecurrent($recurrent)
    {
        $this->data['Recurrent'] = $recurrent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecurrent()
    {
        return $this->data['Recurrent'];
    }

    /**
     * @return $this
     */
    public function removeRecurrent()
    {
        unset($this->data['Recurrent']);

        return $this;
    }
}
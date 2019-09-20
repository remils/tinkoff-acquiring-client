<?php

declare(strict_types=1);

/**
 * URL на веб-сайте продавца, куда будет переведен покупатель в случае успешной оплаты
 * (настраивается в Личном кабинете).
 * Если параметр передан – используется его значение.
 * Если нет – значение в настройках терминала.
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait SuccessURL
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait SuccessURL
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $successURL
     *
     * @return $this
     */
    public function setSuccessURL($successURL)
    {
        $this->data['SuccessURL'] = $successURL;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuccessURL()
    {
        return $this->data['SuccessURL'];
    }

    /**
     * @return $this
     */
    public function removeSuccessURL()
    {
        unset($this->data['SuccessURL']);

        return $this;
    }
}
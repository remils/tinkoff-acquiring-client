<?php

declare(strict_types=1);

/**
 * URL на веб-сайте продавца, куда будет переведен покупатель в случае неуспешной оплаты
 * (настраивается в Личном кабинете).
 * Если параметр передан – используется его значение.
 * Если нет – значение в настройках терминала.
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait FailURL
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait FailURL
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $failURL
     *
     * @return $this
     */
    public function setFailURL($failURL)
    {
        $this->data['FailURL'] = $failURL;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFailURL()
    {
        return $this->data['FailURL'];
    }

    /**
     * @return $this
     */
    public function removeFailURL()
    {
        unset($this->data['FailURL']);

        return $this;
    }
}
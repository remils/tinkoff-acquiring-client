<?php

declare(strict_types=1);

/**
 * Язык платёжной формы.
 * ru - форма оплаты на русском языке;
 * en - форма оплаты на английском языке.
 * По умолчанию (если параметр не передан) - форма оплаты на русском языке
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait Language
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait Language
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->data['Language'] = $language;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->data['Language'];
    }

    /**
     * @return $this
     */
    public function removeLanguage()
    {
        unset($this->data['Language']);

        return $this;
    }
}
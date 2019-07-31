<?php

/**
 * Идентификатор терминала, выдается Продавцу Банком
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait TerminalKey
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait TerminalKey
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $terminalKey
     *
     * @return $this
     */
    public function setTerminalKey($terminalKey)
    {
        $this->data['TerminalKey'] = $terminalKey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerminalKey()
    {
        return $this->data['TerminalKey'];
    }

    /**
     * @return $this
     */
    public function removeTerminalKey()
    {
        unset($this->data['TerminalKey']);

        return $this;
    }
}
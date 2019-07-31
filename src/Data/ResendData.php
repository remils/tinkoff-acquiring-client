<?php

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\BaseData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\TerminalKey;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Token;

/**
 * Class ResendData
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data
 */
class ResendData
{
    use BaseData, TerminalKey, Token;
}
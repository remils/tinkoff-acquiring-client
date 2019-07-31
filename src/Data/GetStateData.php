<?php

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Amount;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\BaseData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\IP;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\PaymentId;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\TerminalKey;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Token;

/**
 * Class GetStateData
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data
 */
class GetStateData
{
    use BaseData, TerminalKey, PaymentId, Amount, IP, Token;
}
<?php

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Amount;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\BaseData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\IP;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\PaymentId;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Receipt;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\TerminalKey;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Token;

/**
 * Class CancelData
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data
 */
class CancelData
{
    use BaseData, TerminalKey, PaymentId, IP, Token, Amount, Receipt;
}
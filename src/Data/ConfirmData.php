<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Amount;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\BaseData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\IP;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\PaymentId;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Receipt;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\TerminalKey;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Token;

/**
 * Class ConfirmData
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data
 */
class ConfirmData
{
    use BaseData, TerminalKey, PaymentId, IP, Amount, Token, Receipt;
}
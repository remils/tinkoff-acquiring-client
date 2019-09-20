<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Amount;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\BaseData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\CustomerKey;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\DATA;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Description;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\FailURL;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\IP;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Language;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\NotificationURL;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\OrderId;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\PayType;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Receipt;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Recurrent;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\RedirectDueDate;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\SuccessURL;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\TerminalKey;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Token;

/**
 * Class InitData
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data
 */
class InitData
{
    use BaseData, TerminalKey, Amount, OrderId, IP, Description, Token, Language, CustomerKey, Recurrent, RedirectDueDate, DATA, NotificationURL, SuccessURL, FailURL, PayType, Receipt;
}
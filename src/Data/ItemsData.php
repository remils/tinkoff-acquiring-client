<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Amount;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\BaseData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Ean13;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Name;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\PaymentMethod;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\PaymentObject;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Price;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Quantity;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\ShopCode;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Tax;

/**
 * Class ItemsData
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data
 */
class ItemsData
{
    use BaseData, Name, Price, Quantity, Amount, PaymentMethod, PaymentObject, Tax, Ean13, ShopCode;
}
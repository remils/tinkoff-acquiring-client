<?php

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\BaseData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Email;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\EmailCompany;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Items;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Phone;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Traits\Taxation;

/**
 * Class ReceiptData
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data
 */
class ReceiptData
{
    use BaseData, Items, Email, Phone, EmailCompany, Taxation;
}
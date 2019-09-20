<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring;

use SergeyZatulivetrov\TinkoffAcquiring\Traits\BaseData;

/**
 * Class ReceiptData (Объект данных чека)
 *
 * @property array  $Items
 * @property string $Email
 * @property string $Phone
 * @property string $EmailCompany
 * @property string $Taxation
 */
class ReceiptData
{
    use BaseData;
}
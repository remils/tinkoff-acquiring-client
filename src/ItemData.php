<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring;

use SergeyZatulivetrov\TinkoffAcquiring\Traits\BaseData;

/**
 * Class ItemData (Массив содержащий в себе информацию о товаре)
 *
 * @property string  $Name
 * @property integer $Price
 * @property float   $Quantity
 * @property integer $Amount
 * @property string  $PaymentMethod
 * @property string  $PaymentObject
 * @property string  $Tax
 * @property string  $Ean13
 * @property string  $ShopCode
 */
class ItemData
{
    use BaseData;
}
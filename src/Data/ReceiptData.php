<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Class ReceiptData (Объект данных чека)
 *
 * @property array $Items
 * @property string $Email
 * @property string $Phone
 * @property string $EmailCompany
 * @property string $Taxation
 */
class ReceiptData extends BaseData
{
    public function __set($name, $value)
    {
        if ($name === 'Items') {
            $value = array_map(static function (ItemData $item) {
                return $item->toArray();
            }, $value);
        }

        parent::__set($name, $value);
    }
}

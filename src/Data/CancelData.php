<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Class CancelData (Отмена платежа)
 *
 * @property string $TerminalKey
 * @property integer $PaymentId
 * @property string $IP
 * @property integer $Amount
 * @property array $Receipt
 */
class CancelData extends BaseDataWithToken
{
    public function __set($name, $value)
    {
        if ($name === 'Receipt') {
            $value = $value->toArray();
        }

        parent::__set($name, $value);
    }
}

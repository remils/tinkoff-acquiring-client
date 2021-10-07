<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Class InitData (Создание заказа)
 *
 * @property string $TerminalKey
 * @property integer $Amount
 * @property string $OrderId
 * @property string $IP
 * @property string $Description
 * @property string $Language
 * @property string $CustomerKey
 * @property string $Recurrent
 * @property string $RedirectDueDate
 * @property array $DATA
 * @property string $NotificationURL
 * @property string $SuccessURL
 * @property string $FailURL
 * @property string $PayType
 * @property array $Receipt
 */
class InitData extends BaseDataWithToken
{
    public function __set($name, $value)
    {
        if ($name === 'Receipt') {
            $value = $value->toArray();
        }

        parent::__set($name, $value);
    }
}

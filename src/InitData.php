<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring;

use SergeyZatulivetrov\TinkoffAcquiring\Traits\BaseDataWithToken;

/**
 * Class InitData (Создание заказа)
 *
 * @property string  $TerminalKey
 * @property integer $Amount
 * @property string  $OrderId
 * @property string  $IP
 * @property string  $Description
 * @property string  $Language
 * @property string  $CustomerKey
 * @property string  $Recurrent
 * @property string  $RedirectDueDate
 * @property array   $DATA
 * @property string  $NotificationURL
 * @property string  $SuccessURL
 * @property string  $FailURL
 * @property string  $PayType
 * @property array   $Receipt
 */
class InitData
{
    use BaseDataWithToken;
}
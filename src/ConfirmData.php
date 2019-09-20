<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring;

use SergeyZatulivetrov\TinkoffAcquiring\Traits\BaseDataWithToken;

/**
 * Class ConfirmData (Подтверждение платежа)
 *
 * @property string  $TerminalKey
 * @property integer $PaymentId
 * @property string  $IP
 * @property integer $Amount
 * @property array   $Receipt
 */
class ConfirmData
{
    use BaseDataWithToken;
}
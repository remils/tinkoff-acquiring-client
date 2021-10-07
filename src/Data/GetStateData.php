<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Class GetStateData (Получить статус платежа)
 *
 * @property string $TerminalKey
 * @property integer $PaymentId
 * @property integer $Amount
 * @property string $IP
 */
class GetStateData extends BaseDataWithToken
{
}

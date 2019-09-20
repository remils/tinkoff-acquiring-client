<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring;

use SergeyZatulivetrov\TinkoffAcquiring\Traits\BaseDataWithToken;

/**
 * Class ResendData (Отправка недоставленных нотификаций)
 *
 * @property string $TerminalKey
 */
class ResendData
{
    use BaseDataWithToken;
}
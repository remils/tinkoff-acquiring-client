<?php
/**
 * Описание https://oplata.tinkoff.ru/landing/develop/documentation/processing_payment
 */

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Class ResendData (Отправка недоставленных нотификаций)
 *
 * @property string $TerminalKey
 */
class ResendData extends BaseDataWithToken
{
}

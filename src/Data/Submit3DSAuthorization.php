<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Carries out test results 3-D Secure
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/Submit3DSAuthorization-request/
 *
 * @property string $MD          Unique transaction identifier in the bank system
 * @property string $PaRes       Encrypted string containing results 3-D Secure authentication
 * @property int    $PaymentId   Unique transaction identifier in the bank system
 * @property string $TerminalKey Terminal ID, issued to the seller by the bank
 */
class Submit3DSAuthorization extends AbstractDataWithToken
{
}

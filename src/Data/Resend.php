<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Sending lackless notifications
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/resend-request/
 *
 * @property string $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 */
class Resend extends AbstractDataWithToken
{
}

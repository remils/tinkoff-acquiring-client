<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Get the status of payment
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/getstate-request/
 *
 * @property string $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property int    $PaymentId   Payment Identifier in the Bank System
 * @property string $IP          Buyer's IP address
 */
class GetState extends AbstractDataWithToken
{
}

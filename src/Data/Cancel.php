<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Cancellation
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/cancel-request/
 *
 * @property string  $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property int     $PaymentId   Payment Identifier in the Bank System
 * @property int     $Amount      Return rate in kopecks
 * @property string  $IP          Buyer's IP address
 * @property Receipt $Receipt     An array of check data
 */
class Cancel extends AbstractDataWithToken
{
}

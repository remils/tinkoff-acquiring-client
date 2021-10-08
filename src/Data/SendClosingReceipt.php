<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Sends a closing check to the cashier
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/SendClosingReceipt-request/
 *
 * @property string  $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property int     $PaymentId   Payment Identifier in the Bank System
 * @property Receipt $Receipt     An array of check data
 */
class SendClosingReceipt extends AbstractDataWithToken
{
}

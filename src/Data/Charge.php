<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Performs auto plates
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/autopayments/charge-request/
 *
 * @property string $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property int    $PaymentId   Payment Identifier in the Bank System
 * @property int    $RebillId    Identifier auto-payment
 * @property bool   $SendEmail   Obtaining a buyer of email notifications
 * @property string $InfoEmail   Email buyer
 * @property string $IP          Buyer's IP address
 */
class Charge extends AbstractDataWithToken
{
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Registers the buyer and its data in the seller's system
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/autopayments/addcustomer-request/
 *
 * @property string $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property string $CustomerKey Buyer identifier in the seller
 * @property string $Email       Email buyer
 * @property string $Phone       Phone buyer in format +71234567890
 * @property string $IP          Buyer's IP address
 */
class AddCustomer extends AbstractDataWithToken
{
}

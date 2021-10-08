<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Returns the buyer's data
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/autopayments/getcustomer-request/
 *
 * @property string $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property string $CustomerKey Buyer identifier in the seller
 * @property string $IP          Buyer's IP address
 */
class GetCustomer extends AbstractDataWithToken
{
}

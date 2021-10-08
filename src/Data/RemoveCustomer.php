<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Removes the registered buyer data
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/autopayments/removecustomer-request/
 *
 * @property string $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property string $CustomerKey Buyer identifier in the seller
 * @property string $IP          Buyer's IP address
 */
class RemoveCustomer extends AbstractDataWithToken
{
}

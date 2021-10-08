<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Removes a tied buyer card
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/autopayments/removecard-request/
 *
 * @property string $TerminalKey Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property string $CustomerKey Buyer identifier in the seller
 * @property string $CardId      Card ID in the Bank System
 * @property string $IP          Buyer's IP address
 */
class RemoveCard extends AbstractDataWithToken
{
}

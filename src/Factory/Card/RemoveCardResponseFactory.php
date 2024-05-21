<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Factory\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\RemoveCardResponse;

/**
 * RemoveCardResponseFactory
 *
 * @phpstan-type TResponse array{
 *      TerminalKey: string,
 *      Status: string,
 *      CustomerKey: string,
 *      CardId: string,
 *      CardType: int,
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class RemoveCardResponseFactory
{
    /**
     * @param TResponse $response
     * @return RemoveCardResponse
     */
    public static function fromArray(array $response): RemoveCardResponse
    {
        return new RemoveCardResponse(
            terminalKey: $response['TerminalKey'],
            status: $response['Status'],
            customerKey: $response['CustomerKey'],
            cardId: $response['CardId'],
            cardType: $response['CardType'],
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null,
        );
    }
}

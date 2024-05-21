<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Factory\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\AddCardResponse;

/**
 * AddCardResponseFactory
 *
 * @phpstan-type TResponse array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      RequestKey: string,
 *      PaymentURL: string,
 *      PaymentId: int|null,
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class AddCardResponseFactory
{
    /**
     * @param TResponse $response
     * @return AddCardResponse
     */
    public static function fromArray(array $response): AddCardResponse
    {
        return new AddCardResponse(
            terminalKey: $response['TerminalKey'],
            customerKey: $response['CustomerKey'],
            requestKey: $response['RequestKey'],
            paymentUrl: $response['PaymentURL'],
            paymentId: $response['PaymentId'] ?? null,
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null,
        );
    }
}

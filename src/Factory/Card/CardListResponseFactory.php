<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Factory\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Card\CardItem;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\CardListResponse;

/**
 * CardListResponseFactory
 *
 * @phpstan-type TCard array{
 *      CardId: string,
 *      Pan: string,
 *      Status: string,
 *      CardType: int,
 *      RebillId: string|null,
 *      ExpDate: string|null
 * }
 *
 * @phpstan-type TFail array{
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class CardListResponseFactory
{
    /**
     * @param TCard[] $response
     * @return CardListResponse
     */
    public static function fromArray(array $response): CardListResponse
    {
        $items = [];

        foreach ($response as $item) {
            $items[] = new CardItem(
                cardId: $item['CardId'],
                pan: $item['Pan'],
                status: $item['Status'],
                cardType: $item['CardType'],
                rebillId: $item['RebillId'] ?? null,
                expDate: $item['ExpDate'] ?? null,
            );
        }

        return new CardListResponse(
            items: $items,
            success: true,
            errorCode: '0',
            message: null,
            details: null,
        );
    }

    /**
     * @param TFail $response
     * @return CardListResponse
     */
    public static function failFromArray(array $response): CardListResponse
    {
        return new CardListResponse(
            items: [],
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null,
        );
    }
}

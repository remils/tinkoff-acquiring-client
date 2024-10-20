<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Card\Card;

/**
 * CardListResponse
 *
 * @phpstan-import-type T from Card as TCard
 */
class CardListResponse
{
    /**
     * @param Card[] $items Список карт пользователя
     */
    public function __construct(
        public readonly array $items,
    ) {
    }

    /**
     * @param TCard[] $data
     * @return CardListResponse
     */
    public static function fromArray(array $data): CardListResponse
    {
        return new CardListResponse(
            items: array_map(Card::fromArray(...), $data),
        );
    }
}

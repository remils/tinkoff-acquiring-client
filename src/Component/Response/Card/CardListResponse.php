<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Component\Card;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * CardListResponse
 *
 * @phpstan-import-type T from Card
 * @phpstan-implements ComponentInterface<array<T>>
 */
class CardListResponse implements ComponentInterface
{
    /**
     * @param Card[] $items Список карт пользователя
     */
    public function __construct(
        public readonly array $items,
    ) {
    }

    public static function factory(array $data): self
    {
        /**
         * @var Card[]
         */
        $items = [];

        foreach ($data as $item) {
            $items[] = Card::factory($item);
        }

        return new CardListResponse(
            items: $items,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T[]
         */
        $items = [];

        foreach ($this->items as $item) {
            $items[] = $item->toArray();
        }

        return $items;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Card\Card;

/**
 * CardListResponse
 *
 * @phpstan-import-type T from Card as TCard
 *
 * @phpstan-type T array{
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class CardListResponse
{
    /**
     * @param Card[] $items Список карт пользователя
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $errorCode Код ошибки. «0» в случае успеха
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     */
    public function __construct(
        public readonly array $items,
        public readonly bool $success,
        public readonly string $errorCode,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
    ) {
    }

    /**
     * @param TCard[] $data
     * @return CardListResponse
     */
    public static function listFromArray(array $data): static
    {
        return new static(
            items: array_map(Card::fromArray(...), $data),
            success: true,
            errorCode: '0',
            message: null,
            details: null,
        );
    }

    /**
     * @param T $data
     * @return CardListResponse
     */
    public static function failFromArray(array $data): static
    {
        return new static(
            items: [],
            success: $data['Success'],
            errorCode: $data['ErrorCode'],
            message: $data['Message'] ?? null,
            details: $data['Details'] ?? null,
        );
    }
}

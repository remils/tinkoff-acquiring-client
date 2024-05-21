<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Card\CardItem;

/**
 * CardListResponse
 */
class CardListResponse
{
    /**
     * @param CardItem[] $items Список карт пользователя
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
}

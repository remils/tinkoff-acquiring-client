<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Card;

/**
 * RemoveCardRequest
 */
class RemoveCardRequest
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string $cardId Идентификатор карты в системе Тинькофф Кассы
     * @param string|null $ip IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly string $cardId,
        public readonly ?string $ip = null,
    ) {
    }
}

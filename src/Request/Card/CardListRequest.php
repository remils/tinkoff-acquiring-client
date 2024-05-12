<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Card;

/**
 * CardListRequest
 */
class CardListRequest
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param bool|null $savedCard Признак сохранения карты для оплаты в 1 клик
     * @param string|null $ip IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?bool $savedCard = null,
        public readonly ?string $ip = null,
    ) {
    }
}

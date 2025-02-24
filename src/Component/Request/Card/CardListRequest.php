<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * CardListRequest
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      IP:          ?string,
 *      SavedCard:   ?bool
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class CardListRequest implements ComponentInterface
{
    /**
     * @param string  $customerKey Идентификатор клиента в системе Продавца
     * @param ?bool   $savedCard   Признак сохранения карты для оплаты в 1 клик
     * @param ?string $ip          IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?bool $savedCard = null,
        public readonly ?string $ip = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new CardListRequest(
            customerKey: $data['CustomerKey'],
            savedCard:   $data['SavedCard'] ?? null,
            ip:          $data['IP'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['CustomerKey'] = $this->customerKey;

        if (null !== $this->savedCard) {
            $data['SavedCard'] = $this->savedCard;
        }

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * RemoveCardRequest
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      CardId:      string,
 *      IP:          ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class RemoveCardRequest implements ComponentInterface
{
    /**
     * @param string  $customerKey Идентификатор клиента в системе Продавца
     * @param string  $cardId      Идентификатор карты в системе Банка
     * @param ?string $ip          IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly string $cardId,
        public readonly ?string $ip = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new RemoveCardRequest(
            customerKey: $data['CustomerKey'],
            cardId:      $data['CardId'],
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
        $data['CardId']      = $this->cardId;

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        return $data;
    }
}

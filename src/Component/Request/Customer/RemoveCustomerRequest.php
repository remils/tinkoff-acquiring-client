<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * RemoveCustomerRequest
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      IP:          ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class RemoveCustomerRequest implements ComponentInterface
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string|null $ip IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?string $ip = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new RemoveCustomerRequest(
            customerKey: $data['CustomerKey'],
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

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        return $data;
    }
}

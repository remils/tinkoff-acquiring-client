<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * CustomerRequest
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      IP:          ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class CustomerRequest implements ComponentInterface
{
    /**
     * @param string  $customerKey Идентификатор клиента в системе Продавца
     * @param ?string $ip          IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?string $ip = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new CustomerRequest(
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

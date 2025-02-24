<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * AddCustomerResponse
 *
 * @phpstan-type T array{
 *      CustomerKey: string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class AddCustomerResponse implements ComponentInterface
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Продавца
     */
    public function __construct(
        public readonly string $customerKey,
    ) {
    }

    public static function factory(array $data): self
    {
        return new AddCustomerResponse(
            customerKey: $data['CustomerKey'],
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['CustomerKey'] = $this->customerKey;

        return $data;
    }
}

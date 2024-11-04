<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Customer;

/**
 * RemoveCustomerResponse
 *
 * @phpstan-type T array{
 *      CustomerKey: string
 * }
 */
class RemoveCustomerResponse
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     */
    public function __construct(
        public readonly string $customerKey,
    ) {
    }

    /**
     * @param T $data
     * @return RemoveCustomerResponse
     */
    public static function fromArray(array $data): RemoveCustomerResponse
    {
        return new RemoveCustomerResponse(
            customerKey: $data['CustomerKey'],
        );
    }
}

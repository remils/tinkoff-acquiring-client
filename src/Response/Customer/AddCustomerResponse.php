<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Customer;

/**
 * AddCustomerResponse
 *
 * @phpstan-type T array{
 *      CustomerKey: string
 * }
 */
class AddCustomerResponse
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
     * @return AddCustomerResponse
     */
    public static function fromArray(array $data): AddCustomerResponse
    {
        return new AddCustomerResponse(
            customerKey: $data['CustomerKey'],
        );
    }
}

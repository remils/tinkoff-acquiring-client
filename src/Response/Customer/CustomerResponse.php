<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Customer;

/**
 * CustomerResponse
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      Email: string|null,
 *      Phone: string|null
 * }
 */
class CustomerResponse
{
    /**
     * @param string      $customerKey Идентификатор клиента в системе Мерчанта
     * @param string|null $email       Email клиента
     * @param string|null $phone       Телефон клиента в формате +{Ц}
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
    ) {
    }

    /**
     * @param T $data
     * @return CustomerResponse
     */
    public static function fromArray(array $data): CustomerResponse
    {
        return new CustomerResponse(
            customerKey: $data['CustomerKey'],
            email: $data['Email'] ?? null,
            phone: $data['Phone'] ?? null,
        );
    }
}

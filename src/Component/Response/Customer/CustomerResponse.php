<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * CustomerResponse
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      Email:       ?string,
 *      Phone:       ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class CustomerResponse implements ComponentInterface
{
    /**
     * @param string  $customerKey Идентификатор клиента в системе Продавца
     * @param ?string $email       Email клиента
     * @param ?string $phone       Телефон клиента в формате +{Ц}
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new CustomerResponse(
            customerKey: $data['CustomerKey'],
            email:       $data['Email'] ?? null,
            phone:       $data['Phone'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['CustomerKey'] = $this->customerKey;

        if (null !== $this->email) {
            $data['Email'] = $this->email;
        }

        if (null !== $this->phone) {
            $data['Phone'] = $this->phone;
        }

        return $data;
    }
}

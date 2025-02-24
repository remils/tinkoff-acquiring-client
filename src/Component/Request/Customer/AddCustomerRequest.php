<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * AddCustomerRequest
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      Email:       ?string,
 *      Phone:       ?string,
 *      IP:          ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class AddCustomerRequest implements ComponentInterface
{
    /**
     * @param string  $customerKey Идентификатор клиента в системе Продавца
     * @param ?string $email       Email клиента
     * @param ?string $phone       Телефон клиента в формате +{Ц}
     * @param ?string $ip          IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $ip = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new AddCustomerRequest(
            customerKey: $data['CustomerKey'],
            email:       $data['Email'] ?? null,
            phone:       $data['Phone'] ?? null,
            ip:          $data['IP'] ?? null,
        );
    }

    /**
     * @inheritDoc
     */
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

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        return $data;
    }
}

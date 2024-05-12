<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Customer;

/**
 * AddCustomerRequest
 */
class AddCustomerRequest
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string|null $email Email клиента
     * @param string|null $phone Телефон клиента в формате +{Ц}
     * @param string|null $ip IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $ip = null,
    ) {
    }
}

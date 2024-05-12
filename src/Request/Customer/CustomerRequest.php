<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Customer;

/**
 * CustomerRequest
 */
class CustomerRequest
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
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Customer;

/**
 * CustomerResponse
 */
class CustomerResponse
{
    /**
     * @param string $terminalKey Идентификатор терминала, выдается Мерчанту Тинькофф Кассой
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $errorCode Код ошибки. «0» в случае успеха
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     * @param string|null $email Email клиента
     * @param string|null $phone Телефон клиента в формате +{Ц}
     */
    public function __construct(
        public readonly string $terminalKey,
        public readonly string $customerKey,
        public readonly bool $success,
        public readonly string $errorCode,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
    ) {
    }
}
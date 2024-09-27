<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Customer;

/**
 * AddCustomerResponse
 *
 * @phpstan-type T array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      ErrorCode: string,
 *      Success: bool,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class AddCustomerResponse
{
    /**
     * @param string $terminalKey Идентификатор терминала, выдается Мерчанту Тинькофф Кассой
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $errorCode Код ошибки. «0» в случае успеха
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     */
    public function __construct(
        public readonly string $terminalKey,
        public readonly string $customerKey,
        public readonly bool $success,
        public readonly string $errorCode,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
    ) {
    }

    /**
     * @param T $data
     * @return AddCustomerResponse
     */
    public static function fromArray(array $data): static
    {
        return new static(
            terminalKey: $data['TerminalKey'],
            customerKey: $data['CustomerKey'],
            success: $data['Success'],
            errorCode: $data['ErrorCode'],
            message: $data['Message'] ?? null,
            details: $data['Details'] ?? null,
        );
    }
}

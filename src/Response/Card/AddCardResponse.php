<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

/**
 * AddCardResponse
 *
 * @phpstan-type T array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      RequestKey: string,
 *      PaymentURL: string,
 *      PaymentId: string|null,
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class AddCardResponse
{
    /**
     * @param string $terminalKey Идентификатор терминала. Выдается Мерчанту Тинькофф Кассой при заведении терминала.
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string $requestKey Идентификатор запроса на привязку карты
     * @param string $paymentUrl Ссылка на страницу привязки карты. На данную страницу необходимо переадресовать клиента
     * для привязки карты.
     * @param string|null $paymentId Идентификатор операции. Не возвращается при CheckType NO
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $errorCode Код ошибки. «0» в случае успеха
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     */
    public function __construct(
        public readonly string $terminalKey,
        public readonly string $customerKey,
        public readonly string $requestKey,
        public readonly string $paymentUrl,
        public readonly bool $success,
        public readonly string $errorCode,
        public readonly ?string $paymentId = null,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
    ) {
    }

    /**
     * @param T $data
     * @return AddCardResponse
     */
    public static function fromArray(array $data): AddCardResponse
    {
        return new AddCardResponse(
            terminalKey: $data['TerminalKey'],
            customerKey: $data['CustomerKey'],
            requestKey: $data['RequestKey'],
            paymentUrl: $data['PaymentURL'],
            paymentId: $data['PaymentId'] ?? null,
            success: $data['Success'],
            errorCode: $data['ErrorCode'],
            message: $data['Message'] ?? null,
            details: $data['Details'] ?? null,
        );
    }
}

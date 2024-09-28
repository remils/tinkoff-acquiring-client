<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Payment;

/**
 * PaymentResponse
 *
 * @phpstan-type T array{
 *      TerminalKey: string,
 *      OrderId: string,
 *      PaymentId: string,
 *      Status: string,
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class PaymentResponse
{
    /**
     * @param string $terminalKey Идентификатор терминала, выдается Продавцу Банком
     * @param string $orderId Номер заказа в системе Продавца
     * @param string $paymentId Уникальный идентификатор транзакции в системе Банка
     * @param string $status Статус транзакции
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $errorCode Код ошибки, «0» - если успешно
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     */
    public function __construct(
        public readonly string $terminalKey,
        public readonly string $orderId,
        public readonly string $paymentId,
        public readonly string $status,
        public readonly bool $success,
        public readonly string $errorCode,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
    ) {
    }

    /**
     * @param T $data
     * @return PaymentResponse
     */
    public static function fromArray(array $data): PaymentResponse
    {
        return new PaymentResponse(
            terminalKey: $data['TerminalKey'],
            orderId: $data['OrderId'],
            paymentId: $data['PaymentId'],
            status: $data['Status'],
            success: $data['Success'],
            errorCode: $data['ErrorCode'],
            message: $data['Message'] ?? null,
            details: $data['Details'] ?? null
        );
    }
}

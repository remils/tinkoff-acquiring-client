<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Payment;

/**
 * InitResponse
 *
 * @phpstan-type T array{
 *      TerminalKey: string,
 *      Amount: int,
 *      OrderId: string,
 *      Success: bool,
 *      Status: string,
 *      PaymentId: string,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class InitResponse
{
    /**
     * @param string $terminalKey Идентификатор терминала, выдается Продавцу Банком
     * @param int $amount Сумма в копейках
     * @param string $orderId Номер заказа в системе Продавца
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $status Статус транзакции
     * @param string $paymentId Уникальный идентификатор транзакции в системе Банка
     * @param string $errorCode Код ошибки, «0» - если успешно
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     */
    public function __construct(
        public readonly string $terminalKey,
        public readonly int $amount,
        public readonly string $orderId,
        public readonly bool $success,
        public readonly string $status,
        public readonly string $paymentId,
        public readonly string $errorCode,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
    ) {
    }

    /**
     * @param T $data
     * @return InitResponse
     */
    public static function fromArray(array $data): InitResponse
    {
        return new InitResponse(
            terminalKey: $data['TerminalKey'],
            amount: $data['Amount'],
            orderId: $data['OrderId'],
            success: $data['Success'],
            status: $data['Status'],
            paymentId: $data['PaymentId'],
            errorCode: $data['ErrorCode'],
            message: $data['Message'] ?? null,
            details: $data['Details'] ?? null
        );
    }
}

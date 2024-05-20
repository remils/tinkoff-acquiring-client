<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Payment;

/**
 * InitResponse
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
}

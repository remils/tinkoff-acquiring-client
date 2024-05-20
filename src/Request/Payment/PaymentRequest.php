<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Payment;

/**
 * PaymentRequest
 */
class PaymentRequest
{
    /**
     * @param string $paymentId Уникальный идентификатор транзакции в системе Тинькофф Кассы
     */
    public function __construct(
        public readonly string $paymentId,
    ) {
    }
}

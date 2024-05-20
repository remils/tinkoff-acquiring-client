<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Payment;

/**
 * StateRequest
 */
class StateRequest
{
    /**
     * @param string $paymentId Идентификатор операции в системе Тинькофф Кассы
     */
    public function __construct(
        public readonly string $paymentId,
    ) {
    }
}

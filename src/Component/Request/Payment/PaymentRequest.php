<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * PaymentRequest
 *
 * @phpstan-type T array{
 *      PaymentId: string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class PaymentRequest implements ComponentInterface
{
    /**
     * @param string $paymentId Уникальный идентификатор транзакции в системе Тинькофф Кассы
     */
    public function __construct(
        public readonly string $paymentId,
    ) {
    }

    public static function factory(array $data): self
    {
        return new PaymentRequest(
            paymentId: $data['PaymentId'],
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['PaymentId'] = $this->paymentId;

        return $data;
    }
}

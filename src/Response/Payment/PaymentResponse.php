<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;

/**
 * PaymentResponse
 *
 * @phpstan-type T array{
 *      OrderId: string,
 *      PaymentId: string,
 *      Status: string
 * }
 */
class PaymentResponse
{
    /**
     * @param string $orderId Номер заказа в системе Продавца
     * @param string $paymentId Уникальный идентификатор транзакции в системе Банка
     * @param PaymentStatusEnum $status Статус транзакции
     */
    public function __construct(
        public readonly string $orderId,
        public readonly string $paymentId,
        public readonly PaymentStatusEnum $status,
    ) {
    }

    /**
     * @param T $data
     * @return PaymentResponse
     */
    public static function fromArray(array $data): PaymentResponse
    {
        return new PaymentResponse(
            orderId: $data['OrderId'],
            paymentId: $data['PaymentId'],
            status: PaymentStatusEnum::from($data['Status']),
        );
    }
}

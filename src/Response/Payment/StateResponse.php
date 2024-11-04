<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;

/**
 * StateResponse
 *
 * @phpstan-type T array{
 *      OrderId: string,
 *      PaymentId: string,
 *      Status: string,
 *      Amount: int|null
 * }
 */
class StateResponse
{
    /**
     * @param string $orderId Номер заказа в системе Продавца
     * @param string $paymentId Уникальный идентификатор транзакции в системе Банка
     * @param PaymentStatusEnum $status Статус транзакции
     * @param int|null $amount Сумма в копейках
     */
    public function __construct(
        public readonly string $orderId,
        public readonly string $paymentId,
        public readonly PaymentStatusEnum $status,
        public readonly ?int $amount = null,
    ) {
    }

    /**
     * @param T $data
     * @return StateResponse
     */
    public static function fromArray(array $data): StateResponse
    {
        return new StateResponse(
            orderId: $data['OrderId'],
            paymentId: $data['PaymentId'],
            status: PaymentStatusEnum::from($data['Status']),
            amount: $data['Amount'] ?? null,
        );
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * PaymentResponse
 *
 * @phpstan-type T array{
 *      OrderId:   string,
 *      PaymentId: string,
 *      Status:    string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class PaymentResponse implements ComponentInterface
{
    /**
     * @param string            $orderId   Номер заказа в системе Продавца
     * @param string            $paymentId Уникальный идентификатор транзакции в системе Банка
     * @param PaymentStatusEnum $status    Статус транзакции
     */
    public function __construct(
        public readonly string $orderId,
        public readonly string $paymentId,
        public readonly PaymentStatusEnum $status,
    ) {
    }

    public static function factory(array $data): self
    {
        return new PaymentResponse(
            orderId:   $data['OrderId'],
            paymentId: $data['PaymentId'],
            status:    PaymentStatusEnum::from($data['Status']),
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['OrderId']   = $this->orderId;
        $data['PaymentId'] = $this->paymentId;
        $data['Status']    = $this->status->value;

        return $data;
    }
}

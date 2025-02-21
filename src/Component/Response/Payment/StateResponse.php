<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * StateResponse
 *
 * @phpstan-type T array{
 *      OrderId:   string,
 *      PaymentId: string,
 *      Status:    string,
 *      Amount:    ?int
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class StateResponse implements ComponentInterface
{
    /**
     * @param string            $orderId   Номер заказа в системе Продавца
     * @param string            $paymentId Уникальный идентификатор транзакции в системе Банка
     * @param PaymentStatusEnum $status    Статус транзакции
     * @param ?int              $amount    Сумма в копейках
     */
    public function __construct(
        public readonly string $orderId,
        public readonly string $paymentId,
        public readonly PaymentStatusEnum $status,
        public readonly ?int $amount = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new StateResponse(
            orderId:   $data['OrderId'],
            paymentId: $data['PaymentId'],
            status:    PaymentStatusEnum::from($data['Status']),
            amount:    $data['Amount'] ?? null,
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

        if (null !== $this->amount) {
            $data['Amount'] = $this->amount;
        }

        return $data;
    }
}

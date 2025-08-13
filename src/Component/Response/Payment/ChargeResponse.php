<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;

/**
 * ChargeResponse
 *
 * @phpstan-type T array{
 *      Amount: int,
 *      OrderId: string,
 *      Status: string,
 *      PaymentId: string,
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class ChargeResponse implements ComponentInterface
{
    /**
     * @param int               $amount    Сумма в копейках
     * @param string            $orderId   Идентификатор заказа в системе мерчанта
     * @param PaymentStatusEnum $status    Статус платежа
     * @param string            $paymentId Идентификатор платежа в системе Т‑Бизнес
     */
    public function __construct(
        public readonly int $amount,
        public readonly string $orderId,
        public readonly PaymentStatusEnum $status,
        public readonly string $paymentId,
    ) {
    }

    public static function factory(array $data): ComponentInterface
    {
        return new ChargeResponse(
            amount: $data['Amount'],
            orderId: $data['OrderId'],
            status: PaymentStatusEnum::from($data['Status']),
            paymentId: $data['PaymentId'],
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['Amount'] = $this->amount;
        $data['OrderId'] = $this->orderId;
        $data['PaymentId'] = $this->paymentId;
        $data['Status'] = $this->status->value;

        return $data;
    }
}

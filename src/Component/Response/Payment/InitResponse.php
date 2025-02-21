<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * InitResponse
 *
 * @phpstan-type T array{
 *      Amount:     int,
 *      OrderId:    string,
 *      Status:     string,
 *      PaymentId:  string,
 *      PaymentURL: ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class InitResponse implements ComponentInterface
{
    /**
     * @param int               $amount     Сумма в копейках
     * @param string            $orderId    Номер заказа в системе Продавца
     * @param PaymentStatusEnum $status     Статус транзакции
     * @param string            $paymentId  Уникальный идентификатор транзакции в системе Банка
     * @param ?string           $paymentUrl Ссылка на платежную форму
     */
    public function __construct(
        public readonly int $amount,
        public readonly string $orderId,
        public readonly PaymentStatusEnum $status,
        public readonly string $paymentId,
        public readonly ?string $paymentUrl,
    ) {
    }

    public static function factory(array $data): self
    {
        return new InitResponse(
            amount:     $data['Amount'],
            orderId:    $data['OrderId'],
            status:     PaymentStatusEnum::from($data['Status']),
            paymentId:  $data['PaymentId'],
            paymentUrl: $data['PaymentURL'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['Amount']    = $this->amount;
        $data['OrderId']   = $this->orderId;
        $data['Status']    = $this->status->value;
        $data['PaymentId'] = $this->paymentId;

        if (null !== $this->paymentUrl) {
            $data['PaymentURL'] = $this->paymentUrl;
        }

        return $data;
    }
}

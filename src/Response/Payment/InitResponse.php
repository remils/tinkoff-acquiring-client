<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;

/**
 * InitResponse
 *
 * @phpstan-type T array{
 *      Amount: int,
 *      OrderId: string,
 *      Status: string,
 *      PaymentId: string,
 *      PaymentURL: string|null
 * }
 */
class InitResponse
{
    /**
     * @param int $amount Сумма в копейках
     * @param string $orderId Номер заказа в системе Продавца
     * @param PaymentStatusEnum $status Статус транзакции
     * @param string $paymentId Уникальный идентификатор транзакции в системе Банка
     * @param string|null $paymentUrl Ссылка на платежную форму. Параметр возвращается только для мерчантов без PCI DSS.
     */
    public function __construct(
        public readonly int $amount,
        public readonly string $orderId,
        public readonly PaymentStatusEnum $status,
        public readonly string $paymentId,
        public readonly ?string $paymentUrl,
    ) {
    }

    /**
     * @param T $data
     * @return InitResponse
     */
    public static function fromArray(array $data): InitResponse
    {
        return new InitResponse(
            amount: $data['Amount'],
            orderId: $data['OrderId'],
            status: PaymentStatusEnum::from($data['Status']),
            paymentId: $data['PaymentId'],
            paymentUrl: $data['PaymentURL'] ?? null,
        );
    }
}

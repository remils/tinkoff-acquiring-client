<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Component\Param;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Collection\ParamCollection;

/**
 * ConfirmResponse
 *
 * @phpstan-import-type T from Param as TParam
 * @phpstan-type T array{
 *      OrderId:    string,
 *      Status:     string,
 *      PaymentId:  string,
 *      Params:     array<TParam>,
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class ConfirmResponse implements ComponentInterface
{
    /**
     * @param string            $orderId    Номер заказа в системе Продавца
     * @param PaymentStatusEnum $status     Статус транзакции
     * @param string            $paymentId  Уникальный идентификатор транзакции в системе Банка
     * @param ?ParamCollection  $params     Детали для платежей в рассрочку
     */
    public function __construct(
        public readonly string $orderId,
        public readonly PaymentStatusEnum $status,
        public readonly string $paymentId,
        public readonly ?ParamCollection $params,
    ) {
    }

    public static function factory(array $data): self
    {
        return new ConfirmResponse(
            orderId:    $data['OrderId'],
            status:     PaymentStatusEnum::from($data['Status']),
            paymentId:  $data['PaymentId'],
            params:     empty($data['Params']) ? null : ParamCollection::factory($data['Params']),
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['OrderId']   = $this->orderId;
        $data['Status']    = $this->status->value;
        $data['PaymentId'] = $this->paymentId;

        if ($this->params !== null) {
            $data['Params'] = $this->params->toArray();
        }

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * StateRequest
 *
 * @phpstan-type T array{
 *      PaymentId: string,
 *      IP:        ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class StateRequest implements ComponentInterface
{
    /**
     * @param string  $paymentId Идентификатор операции в системе Банка
     * @param ?string $ip        IP адрес клиента
     */
    public function __construct(
        public readonly string $paymentId,
        public readonly ?string $ip = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new StateRequest(
            paymentId: $data['PaymentId'],
            ip:        $data['IP'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['PaymentId'] = $this->paymentId;

        if ($this->ip !== null) {
            $data['IP'] = $this->ip;
        }

        return $data;
    }
}

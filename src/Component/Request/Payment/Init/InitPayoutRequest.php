<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\Init;

/**
 * InitPayoutRequest
 *
 * Инициализация выплаты
 *
 * @phpstan-type TData array<string,string>
 * @phpstan-type T array{
 *      OrderId: string,
 *      CardId:  string,
 *      Amount:  int,
 *      DATA:    ?TData
 * }
 * @phpstan-implements InitRequestInterface<T>
 */
class InitPayoutRequest implements InitRequestInterface
{
    /**
     * @param string $orderId Уникальный номер заказа в системе Продавца
     * @param string $cardId  Идентификатор карты пополнения
     * @param int    $amount  Сумма в копейках
     * @param ?TData $data    Дополнительные параметры
     */
    public function __construct(
        public readonly string $orderId,
        public readonly int $amount,
        public readonly string $cardId,
        public readonly ?array $data = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new InitPayoutRequest(
            orderId: $data['OrderId'],
            amount:  $data['Amount'],
            cardId:  $data['CardId'],
            data:    $data['DATA'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['OrderId'] = $this->orderId;
        $data['CardId']  = $this->cardId;
        $data['Amount']  = $this->amount;

        if (null !== $this->data) {
            $data['DATA'] = $this->data;
        }

        return $data;
    }
}

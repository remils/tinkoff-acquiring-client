<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Payment;

/**
 * InitRequest
 */
class InitRequest
{
    /**
     * @param string $orderId Уникальный номер заказа в системе Мерчанта
     * @param string $cardId Идентификатор карты пополнения привязанной с помощью метода AddCard
     * @param int $amount Сумма в копейках
     * @param array<string,mixed>|null $data Дополнительные параметры
     */
    public function __construct(
        public readonly string $orderId,
        public readonly int $amount,
        public readonly string $cardId,
        public readonly ?array $data = null,
    ) {
    }
}

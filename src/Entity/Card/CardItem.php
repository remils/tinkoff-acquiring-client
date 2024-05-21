<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Card;

/**
 * CardItem
 */
class CardItem
{
    /**
     * @param string $cardId Идентификатор карты в системе Тинькофф Кассы
     * @param string $pan Номер карты
     * @param string $status Статус карты:
     * - A – активная,
     * - I – не активная,
     * - D - удаленная.
     * @param int $cardType Тип карты:
     * - карта списания (0);
     * - карта пополнения (1);
     * - карта пополнения и списания (2).
     * @param string|null $rebillId Идентификатор рекуррентного платежа
     * @param string|null $expDate Срок действия карты
     */
    public function __construct(
        public readonly string $cardId,
        public readonly string $pan,
        public readonly string $status,
        public readonly int $cardType,
        public readonly ?string $rebillId = null,
        public readonly ?string $expDate = null,
    ) {
    }
}

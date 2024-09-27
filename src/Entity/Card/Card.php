<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Card;

/**
 * CardItem
 *
 * @phpstan-type T array{
 *      CardId: string,
 *      Pan: string,
 *      Status: string,
 *      CardType: int,
 *      RebillId: string|null,
 *      ExpDate: string|null
 * }
 */
class Card
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

    /**
     * @param T $data
     * @return Card
     */
    public static function fromArray($data): static
    {
        return new static(
            cardId: $data['CardId'],
            pan: $data['Pan'],
            status: $data['Status'],
            cardType: $data['CardType'],
            rebillId: $data['RebillId'] ?? null,
            expDate: $data['ExpDate'] ?? null,
        );
    }
}

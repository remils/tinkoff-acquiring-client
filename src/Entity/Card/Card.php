<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardTypeEnum;

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
     * @param CardStatusEnum $status Статус карты
     * @param CardTypeEnum $cardType Тип карты
     * @param string|null $rebillId Идентификатор рекуррентного платежа
     * @param string|null $expDate Срок действия карты
     */
    public function __construct(
        public readonly string $cardId,
        public readonly string $pan,
        public readonly CardStatusEnum $status,
        public readonly CardTypeEnum $cardType,
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
            status: CardStatusEnum::from($data['Status']),
            cardType: CardTypeEnum::from($data['CardType']),
            rebillId: $data['RebillId'] ?? null,
            expDate: $data['ExpDate'] ?? null,
        );
    }
}

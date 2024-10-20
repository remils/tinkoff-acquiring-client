<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardTypeEnum;

/**
 * RemoveCardResponse
 *
 * @phpstan-type T array{
 *      Status: string,
 *      CustomerKey: string,
 *      CardId: string,
 *      CardType: int
 * }
 */
class RemoveCardResponse
{
    /**
     * @param CardStatusEnum $status      Статус карты
     * @param string         $customerKey Идентификатор клиента в системе Мерчанта
     * @param string         $cardId      Идентификатор карты в системе Тинькофф Кассы
     * @param CardTypeEnum   $cardType    Тип карты
     */
    public function __construct(
        public readonly CardStatusEnum $status,
        public readonly string $customerKey,
        public readonly string $cardId,
        public readonly CardTypeEnum $cardType,
    ) {
    }

    /**
     * @param T $data
     * @return RemoveCardResponse
     */
    public static function fromArray(array $data): RemoveCardResponse
    {
        return new RemoveCardResponse(
            status: CardStatusEnum::from($data['Status']),
            customerKey: $data['CustomerKey'],
            cardId: $data['CardId'],
            cardType: CardTypeEnum::from($data['CardType']),
        );
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardTypeEnum;

/**
 * RemoveCardResponse
 *
 * @phpstan-type T array{
 *      Status:      string,
 *      CustomerKey: string,
 *      CardId:      string,
 *      CardType:    int
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class RemoveCardResponse implements ComponentInterface
{
    /**
     * @param CardStatusEnum $status      Статус карты
     * @param string         $customerKey Идентификатор клиента в системе Продавца
     * @param string         $cardId      Идентификатор карты в системе Банка
     * @param CardTypeEnum   $cardType    Тип карты
     */
    public function __construct(
        public readonly CardStatusEnum $status,
        public readonly string $customerKey,
        public readonly string $cardId,
        public readonly CardTypeEnum $cardType,
    ) {
    }

    public static function factory(array $data): self
    {
        return new RemoveCardResponse(
            status:      CardStatusEnum::from($data['Status']),
            customerKey: $data['CustomerKey'],
            cardId:      $data['CardId'],
            cardType:    CardTypeEnum::from($data['CardType']),
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['Status']      = $this->status->value;
        $data['CustomerKey'] = $this->customerKey;
        $data['CardId']      = $this->cardId;
        $data['CardType']    = $this->cardType->value;

        return $data;
    }
}

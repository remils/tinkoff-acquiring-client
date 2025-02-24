<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardTypeEnum;

/**
 * Card
 *
 * @phpstan-type T array{
 *      CardId:   string,
 *      Pan:      string,
 *      Status:   string,
 *      CardType: int,
 *      RebillId: ?string,
 *      ExpDate:  ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class Card implements ComponentInterface
{
    /**
     * @param string         $cardId   Идентификатор карты в системе Тинькофф Кассы
     * @param string         $pan      Номер карты
     * @param CardStatusEnum $status   Статус карты
     * @param CardTypeEnum   $cardType Тип карты
     * @param ?string        $rebillId Идентификатор рекуррентного платежа
     * @param ?string        $expDate  Срок действия карты
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

    public static function factory(array $data): self
    {
        return new Card(
            cardId:   $data['CardId'],
            pan:      $data['Pan'],
            status:   CardStatusEnum::from($data['Status']),
            cardType: CardTypeEnum::from($data['CardType']),
            rebillId: $data['RebillId'] ?? null,
            expDate:  $data['ExpDate'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['CardId']   = $this->cardId;
        $data['Pan']      = $this->pan;
        $data['Status']   = $this->status->value;
        $data['CardType'] = $this->cardType->value;

        if (null !== $this->rebillId) {
            $data['RebillId'] = $this->rebillId;
        }

        if (null !== $this->expDate) {
            $data['ExpDate'] = $this->expDate;
        }

        return $data;
    }
}

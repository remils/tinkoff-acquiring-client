<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CheckTypeEnum;

/**
 * AddCardRequest
 *
 * @phpstan-type T array{
 *      CustomerKey:   string,
 *      IP:            ?string,
 *      CheckType:     ?string,
 *      ResidentState: ?bool
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class AddCardRequest implements ComponentInterface
{
    /**
     * @param string         $customerKey   Идентификатор клиента в системе Продавца
     * @param ?string        $ip            IP-адрес запроса
     * @param ?CheckTypeEnum $checkType     Если CheckType не передается, автоматически проставляется значение NO
     * @param ?bool          $residentState Признак резидентности добавляемой карты
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?CheckTypeEnum $checkType = null,
        public readonly ?bool $residentState = null,
        public readonly ?string $ip = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new AddCardRequest(
            customerKey:   $data['CustomerKey'],
            checkType:     empty($data['CheckType']) ? null : CheckTypeEnum::from($data['CheckType']),
            residentState: $data['ResidentState'] ?? null,
            ip:            $data['IP'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['CustomerKey'] = $this->customerKey;

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        if (null !== $this->checkType) {
            $data['CheckType'] = $this->checkType->value;
        }

        if (null !== $this->residentState) {
            $data['ResidentState'] = $this->residentState;
        }

        return $data;
    }
}

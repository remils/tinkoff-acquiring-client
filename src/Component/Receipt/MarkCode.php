<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\MarkCodeTypeEnum;

/**
 * MarkCode
 *
 * @phpstan-type T array{
 *      MarkCodeType: string,
 *      Value:        string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class MarkCode implements ComponentInterface
{
    /**
     * @param MarkCodeTypeEnum $markCodeType Тип штрих кода
     * @param string           $value        Код маркировки
     */
    public function __construct(
        public readonly MarkCodeTypeEnum $markCodeType,
        public readonly string $value,
    ) {
    }

    public static function factory(array $data): self
    {
        return new MarkCode(
            markCodeType: MarkCodeTypeEnum::from($data['MarkCodeType']),
            value:        $data['Value'],
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['MarkCodeType'] = $this->markCodeType->value;
        $data['Value']        = $this->value;

        return $data;
    }
}

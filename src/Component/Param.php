<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\ParamKeyEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\RouteEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\SourceEnum;

/**
 * Param
 *
 * @phpstan-type T array{
 *      Key: string,
 *      Value: string,
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class Param implements ComponentInterface
{
    /**
     * @param ParamKeyEnum $key               Ключ
     * @param SourceEnum|RouteEnum|int $value Значение
     */
    public function __construct(
        public readonly ParamKeyEnum $key,
        public readonly SourceEnum|RouteEnum|int $value,
    ) {
    }

    public static function factory(array $data): self
    {
        $key = ParamKeyEnum::from($data['Key']);

        return new Param(
            key: $key,
            value: match ($key) {
                ParamKeyEnum::Source => SourceEnum::from($data['Value']),
                ParamKeyEnum::Route  => RouteEnum::from($data['Value']),
                ParamKeyEnum::CreditAmount => $data['Value'],
            },
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['Key'] = $this->key->value;

        $data['Value'] = match ($this->key) {
            ParamKeyEnum::Source => $this->value->value,
            ParamKeyEnum::Route => $this->value->value,
            ParamKeyEnum::CreditAmount => strval($this->value),
        };

        return $data;
    }
}

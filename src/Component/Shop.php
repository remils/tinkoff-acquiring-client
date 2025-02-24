<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * Shop
 *
 * @phpstan-type T array{
 *      ShopCode: string,
 *      Amount:   int,
 *      Name:     ?string,
 *      Fee:      ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class Shop implements ComponentInterface
{
    /**
     * @param string  $shopCode Код магазина
     * @param int     $amount   Сумма в копейках, которая относится к указанному ShopCode
     * @param ?string $name     Наименование товара
     * @param ?string $fee      Сумма комиссии в копейках, удерживаемая из возмещения партнера в пользу Продавца
     */
    public function __construct(
        public readonly string $shopCode,
        public readonly int $amount,
        public readonly ?string $name = null,
        public readonly ?string $fee = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new Shop(
            shopCode: $data['ShopCode'],
            amount:   $data['Amount'],
            name:     $data['Name'] ?? null,
            fee:      $data['Fee'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['ShopCode'] = $this->shopCode;
        $data['Amount']   = $this->amount;

        if (null !== $this->name) {
            $data['Name'] = $this->name;
        }

        if (null !== $this->fee) {
            $data['Fee'] = $this->fee;
        }

        return $data;
    }
}

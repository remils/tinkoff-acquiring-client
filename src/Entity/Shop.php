<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity;

/**
 * Shop
 *
 * @phpstan-type TData array{
 *      ShopCode: string,
 *      Amount: int,
 *      Name: string,
 *      Fee: string
 * }
 */
class Shop
{
    /**
     * @param string $shopCode Код магазина
     * @param int $amount Cумма в копейках, которая относится к указанному ShopCode.
     * @param ?string $name Наименование товара.
     * @param ?string $fee Сумма комиссии в копейках, удерживаемая из возмещения партнера в пользу
     *                     маркетплейса. Если не передано, используется комиссия, указанная при регистрации.
     */
    public function __construct(
        public readonly string $shopCode,
        public readonly int $amount,
        public readonly ?string $name = null,
        public readonly ?string $fee = null,
    ) {
    }

    /**
     * @return TData
     */
    public function toArray(): array
    {
        /**
         * @var TData $data
         */
        $data = [];
        $data['ShopCode'] = $this->shopCode;
        $data['Amount'] = $this->amount;

        if (null !== $this->name) {
            $data['Name'] = $this->name;
        }

        if (null !== $this->fee) {
            $data['Fee'] = $this->fee;
        }

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Component\Collection\ShopCollection;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt\Receipt;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Shop;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\RouteEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\SourceEnum;

/**
 * ConfirmRequest
 *
 * @phpstan-import-type T from Receipt as TReceipt
 * @phpstan-import-type T from Shop as TShop
 * @phpstan-type T array{
 *      PaymentId: string,
 *      IP:        ?string,
 *      Amount:    ?int,
 *      Receipt:   ?TReceipt,
 *      Shops:     ?array<TShop>,
 *      Route:     ?string,
 *      Source:    ?string,
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class ConfirmRequest implements ComponentInterface
{
    /**
     * @param string          $paymentId Идентификатор операции в системе Банка
     * @param ?string         $ip        IP адрес клиента
     * @param ?int            $amount    Сумма в копейках
     * @param ?Receipt        $receipt   JSON-объект с данными чека
     * @param ?ShopCollection $shops     JSON-объект с данными маркетплейса
     * @param ?RouteEnum      $route     Способ платежа
     * @param ?SourceEnum     $source    Источник платежа
     */
    public function __construct(
        public readonly string $paymentId,
        public readonly ?string $ip = null,
        public readonly ?int $amount = null,
        public readonly ?Receipt $receipt = null,
        public readonly ?ShopCollection $shops = null,
        public readonly ?RouteEnum $route = null,
        public readonly ?SourceEnum $source = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new ConfirmRequest(
            paymentId: $data['PaymentId'],
            ip:        $data['IP'] ?? null,
            amount:    $data['Amount'] ?? null,
            receipt:   empty($data['Receipt']) ? null : Receipt::factory($data['Receipt']),
            shops:     empty($data['Shops']) ? null : ShopCollection::factory($data['Shops']),
            route:     empty($data['Route']) ? null : RouteEnum::from($data['Route']),
            source:    empty($data['Source']) ? null : SourceEnum::from($data['Source']),
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['PaymentId'] = $this->paymentId;

        if ($this->ip !== null) {
            $data['IP'] = $this->ip;
        }

        if ($this->amount !== null) {
            $data['Amount'] = $this->amount;
        }

        if ($this->receipt !== null) {
            $data['Receipt'] = $this->receipt->toArray();
        }

        if ($this->shops !== null) {
            $data['Shops'] = $this->shops->toArray();
        }

        if ($this->route !== null) {
            $data['Route'] = $this->route->value;
        }

        if ($this->source !== null) {
            $data['Source'] = $this->source->value;
        }

        return $data;
    }
}

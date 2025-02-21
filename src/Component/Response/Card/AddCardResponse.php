<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * AddCardResponse
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      RequestKey:  string,
 *      PaymentURL:  string,
 *      PaymentId:   ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class AddCardResponse implements ComponentInterface
{
    /**
     * @param string  $customerKey Идентификатор клиента в системе Продавца
     * @param string  $requestKey  Идентификатор запроса на привязку карты
     * @param string  $paymentUrl  Ссылка на страницу привязки карты
     * @param ?string $paymentId   Идентификатор операции
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly string $requestKey,
        public readonly string $paymentUrl,
        public readonly ?string $paymentId = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new AddCardResponse(
            customerKey: $data['CustomerKey'],
            requestKey:  $data['RequestKey'],
            paymentUrl:  $data['PaymentURL'],
            paymentId:   $data['PaymentId'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['CustomerKey'] = $this->customerKey;
        $data['RequestKey']  = $this->requestKey;
        $data['PaymentURL']  = $this->paymentUrl;

        if (null !== $this->paymentId) {
            $data['PaymentId'] = $this->paymentId;
        }

        return $data;
    }
}

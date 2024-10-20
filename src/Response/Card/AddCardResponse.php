<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

/**
 * AddCardResponse
 *
 * @phpstan-type T array{
 *      CustomerKey: string,
 *      RequestKey: string,
 *      PaymentURL: string,
 *      PaymentId: string|null
 * }
 */
class AddCardResponse
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string $requestKey  Идентификатор запроса на привязку карты
     * @param string $paymentUrl  Ссылка на страницу привязки карты. На данную страницу необходимо переадресовать
     *                            клиента для привязки карты.
     * @param string $paymentId   Идентификатор операции. Не возвращается при CheckType NO
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly string $requestKey,
        public readonly string $paymentUrl,
        public readonly ?string $paymentId = null,
    ) {
    }

    /**
     * @param T $data
     * @return AddCardResponse
     */
    public static function fromArray(array $data): AddCardResponse
    {
        return new AddCardResponse(
            customerKey: $data['CustomerKey'],
            requestKey: $data['RequestKey'],
            paymentUrl: $data['PaymentURL'],
            paymentId: $data['PaymentId'] ?? null,
        );
    }
}

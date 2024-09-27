<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Request\RequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CardListRequest
 *
 * @phpstan-type T array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      IP: string|null,
 *      SavedCard: bool|null
 * }
 *
 * @implements RequestInterface<T>
 */
class CardListRequest implements RequestInterface
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param bool|null $savedCard Признак сохранения карты для оплаты в 1 клик
     * @param string|null $ip IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?bool $savedCard = null,
        public readonly ?string $ip = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function build(string $terminalKey, SignatureServiceInterface $signatureService)
    {
        /**
         * @var T $data
         */
        $data = [
            'TerminalKey' => $terminalKey,
            'CustomerKey' => $this->customerKey,
        ];

        if (null !== $this->savedCard) {
            $data['SavedCard'] = $this->savedCard;
        }

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        return $signatureService->signedRequest($data);
    }
}

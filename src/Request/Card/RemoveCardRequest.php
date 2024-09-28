<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Request\RequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * RemoveCardRequest
 *
 * @template TSignatureData of array<string,string>
 *
 * @phpstan-type TData array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      CardId: string,
 *      IP: string|null
 * }
 *
 * @implements RequestInterface<TData,TSignatureData>
 */
class RemoveCardRequest implements RequestInterface
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string $cardId Идентификатор карты в системе Тинькофф Кассы
     * @param string|null $ip IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly string $cardId,
        public readonly ?string $ip = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function build(string $terminalKey, SignatureServiceInterface $signatureService)
    {
        /**
         * @var TData $data
         */
        $data = [
            'TerminalKey' => $terminalKey,
            'CustomerKey' => $this->customerKey,
            'CardId' => $this->cardId,
        ];

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        return $signatureService->signedRequest($data);
    }
}

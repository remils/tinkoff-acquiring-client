<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Request\RequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * RemoveCustomerRequest
 *
 * @template TSignatureData of array<string,string>
 *
 * @phpstan-type TData array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      IP: string|null
 * }
 *
 * @implements RequestInterface<TData,TSignatureData>
 */
class RemoveCustomerRequest implements RequestInterface
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string|null $ip IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
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
        ];

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        return $signatureService->signedRequest($data);
    }
}

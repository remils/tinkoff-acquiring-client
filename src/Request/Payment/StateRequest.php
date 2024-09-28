<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Request\RequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * StateRequest
 *
 * @template TSignatureData of array<string,string>
 *
 * @phpstan-type TData array{
 *      TerminalKey: string,
 *      PaymentId: string,
 *      IP: string
 * }
 *
 * @implements RequestInterface<TData,TSignatureData>
 */
class StateRequest implements RequestInterface
{
    /**
     * @param string $paymentId Идентификатор операции в системе Тинькофф Кассы
     * @param string|null $ip IP адрес клиента
     */
    public function __construct(
        public readonly string $paymentId,
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
            'PaymentId' => $this->paymentId,
        ];

        if ($this->ip !== null) {
            $data['IP'] = $this->ip;
        }

        return $signatureService->signedRequest($data);
    }
}

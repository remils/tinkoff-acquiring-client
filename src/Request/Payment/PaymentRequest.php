<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Request\RequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * PaymentRequest
 *
 * @template TSignatureData of array<string,string>
 *
 * @phpstan-type TData array{
 *      TerminalKey: string,
 *      PaymentId: string
 * }
 *
 * @implements RequestInterface<TData,TSignatureData>
 */
class PaymentRequest implements RequestInterface
{
    /**
     * @param string $paymentId Уникальный идентификатор транзакции в системе Тинькофф Кассы
     */
    public function __construct(
        public readonly string $paymentId,
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

        return $signatureService->signedRequest($data);
    }
}

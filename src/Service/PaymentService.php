<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\Init\InitRequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\PaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\StateRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Payment\InitResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Payment\PaymentResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Payment\StateResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * PaymentService
 *
 * @template TSignatureData of array<string,string>
 */
class PaymentService
{
    /**
     * @param string $terminalKey
     * @param SignatureServiceInterface<TSignatureData> $signatureService
     * @param ClientInterface $client
     */
    public function __construct(
        protected readonly string $terminalKey,
        protected readonly SignatureServiceInterface $signatureService,
        protected readonly ClientInterface $client,
    ) {
    }

    /**
     * Инициирует выплату, либо оплату
     * @phpstan-ignore-next-line
     * @param InitRequestInterface $request
     * @return InitResponse
     * @throws TinkoffException|HttpException
     */
    public function init(InitRequestInterface $request): InitResponse
    {
        $response = $this->client->execute(
            action: 'Init',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return InitResponse::fromArray($response);
    }

    /**
     * Производит пополнение карты
     * @param PaymentRequest<TSignatureData> $request
     * @return PaymentResponse
     * @throws TinkoffException|HttpException
     */
    public function payment(PaymentRequest $request): PaymentResponse
    {
        $response = $this->client->execute(
            action: 'Payment',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return PaymentResponse::fromArray($response);
    }

    /**
     * Возвращает текущий статус выплаты
     * @param StateRequest<TSignatureData> $request
     * @return StateResponse
     * @throws TinkoffException|HttpException
     */
    public function state(StateRequest $request): StateResponse
    {
        $response = $this->client->execute(
            action: 'GetState',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return StateResponse::fromArray($response);
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\Init\InitRequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\PaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\StateRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\InitResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\PaymentResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\StateResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * PaymentService
 *
 * @template TSignatureData of array<string,string>
 */
class PaymentService
{
    /**
     * @param SignatureServiceInterface<TSignatureData> $signatureService
     * @param ClientInterface $client
     */
    public function __construct(
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
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'Init',
            data: array_merge($signatureData, $data),
        );

        return InitResponse::factory($response);
    }

    /**
     * Производит пополнение карты
     * @param PaymentRequest $request
     * @return PaymentResponse
     * @throws TinkoffException|HttpException
     */
    public function payment(PaymentRequest $request): PaymentResponse
    {
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'Payment',
            data: array_merge($signatureData, $data),
        );

        return PaymentResponse::factory($response);
    }

    /**
     * Возвращает текущий статус выплаты
     * @param StateRequest $request
     * @return StateResponse
     * @throws TinkoffException|HttpException
     */
    public function state(StateRequest $request): StateResponse
    {
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'GetState',
            data: array_merge($signatureData, $data),
        );

        return StateResponse::factory($response);
    }
}

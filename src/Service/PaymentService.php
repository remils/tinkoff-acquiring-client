<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\Init\InitRequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\PaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\StateRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\InitResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\PaymentResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\StateResponse;

/**
 * PaymentService
 *
 * @phpstan-template TSignatureData of array<string,string>
 * @phpstan-extends AbstractService<TSignatureData>
 */
class PaymentService extends AbstractService
{
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
            data: $this->signedRequest($request->toArray()),
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
        $response = $this->client->execute(
            action: 'Payment',
            data: $this->signedRequest($request->toArray()),
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
        $response = $this->client->execute(
            action: 'GetState',
            data: $this->signedRequest($request->toArray()),
        );

        return StateResponse::factory($response);
    }
}

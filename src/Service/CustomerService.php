<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\AddCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\CustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\RemoveCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Customer\AddCustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Customer\CustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Customer\RemoveCustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CustomerService
 *
 * @template TSignatureData of array<string,string>
 */
class CustomerService
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
     * Регистрирует клиента в связке с терминалом.
     * Возможна автоматическая привязка клиента и карты, по которой был совершен платеж,
     * при передаче параметра CustomerKey в методе Init. Это можно использовать для сохранения
     * и последующего отображения клиенту замаскированного номера карты, по которой будет
     * совершен рекуррентный платеж
     * @param AddCustomerRequest $request
     * @return AddCustomerResponse
     * @throws TinkoffException|HttpException
     */
    public function addCustomer(AddCustomerRequest $request): AddCustomerResponse
    {
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'AddCustomer',
            data: array_merge($signatureData, $data),
        );

        return AddCustomerResponse::factory($response);
    }

    /**
     * Возвращает данные клиента, сохраненные в связке с терминалом
     * @param CustomerRequest $request
     * @return CustomerResponse
     * @throws TinkoffException|HttpException
     */
    public function customer(CustomerRequest $request): CustomerResponse
    {
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'GetCustomer',
            data: array_merge($signatureData, $data),
        );

        return CustomerResponse::factory($response);
    }

    /**
     * Удаляет сохраненные данные клиента
     * @param RemoveCustomerRequest $request
     * @return RemoveCustomerResponse
     * @throws TinkoffException|HttpException
     */
    public function removeCustomer(RemoveCustomerRequest $request): RemoveCustomerResponse
    {
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'RemoveCustomer',
            data: array_merge($signatureData, $data),
        );

        return RemoveCustomerResponse::factory($response);
    }
}

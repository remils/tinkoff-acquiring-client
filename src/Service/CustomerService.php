<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\AddCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\CustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\RemoveCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Customer\AddCustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Customer\CustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Customer\RemoveCustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CustomerService
 *
 * @template TSignatureData of array<string,string>
 */
class CustomerService
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
     * Регистрирует клиента в связке с терминалом.
     * Возможна автоматическая привязка клиента и карты, по которой был совершен платеж,
     * при передаче параметра CustomerKey в методе Init. Это можно использовать для сохранения
     * и последующего отображения клиенту замаскированного номера карты, по которой будет
     * совершен рекуррентный платеж
     * @param AddCustomerRequest<TSignatureData> $request
     * @return AddCustomerResponse
     * @throws TinkoffException|HttpException
     */
    public function addCustomer(AddCustomerRequest $request): AddCustomerResponse
    {
        $response = $this->client->execute(
            action: 'AddCustomer',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return AddCustomerResponse::fromArray($response);
    }

    /**
     * Возвращает данные клиента, сохраненные в связке с терминалом
     * @param CustomerRequest<TSignatureData> $request
     * @return CustomerResponse
     * @throws TinkoffException|HttpException
     */
    public function customer(CustomerRequest $request): CustomerResponse
    {
        $response = $this->client->execute(
            action: 'GetCustomer',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return CustomerResponse::fromArray($response);
    }

    /**
     * Удаляет сохраненные данные клиента
     * @param RemoveCustomerRequest<TSignatureData> $request
     * @return RemoveCustomerResponse
     * @throws TinkoffException|HttpException
     */
    public function removeCustomer(RemoveCustomerRequest $request): RemoveCustomerResponse
    {
        $response = $this->client->execute(
            action: 'RemoveCustomer',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return RemoveCustomerResponse::fromArray($response);
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Mapper\Customer\AddCustomerRequestMapper;
use SergeyZatulivetrov\TinkoffAcquiring\Mapper\Customer\CustomerRequestMapper;
use SergeyZatulivetrov\TinkoffAcquiring\Mapper\Customer\RemoveCustomerRequestMapper;
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
 * @phpstan-type TAddCustomer array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      ErrorCode: string,
 *      Success: bool,
 *      Message: string|null,
 *      Details: string|null
 * }
 *
 * @phpstan-type TCustomer array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      ErrorCode: string,
 *      Success: bool,
 *      Message: string|null,
 *      Details: string|null,
 *      Email: string|null,
 *      Phone: string|null
 * }
 *
 * @phpstan-type TRemoveCustomer array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      ErrorCode: string,
 *      Success: bool,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class CustomerService
{
    protected readonly AddCustomerRequestMapper $addCustomerRequestMapper;

    protected readonly CustomerRequestMapper $customerRequestMapper;

    protected readonly RemoveCustomerRequestMapper $removeCustomerRequestMapper;

    public function __construct(
        protected readonly string $terminalKey,
        protected readonly SignatureServiceInterface $signatureService,
        protected readonly ClientInterface $client,
    ) {
        $this->addCustomerRequestMapper = new AddCustomerRequestMapper($terminalKey);
        $this->customerRequestMapper = new CustomerRequestMapper($terminalKey);
        $this->removeCustomerRequestMapper = new RemoveCustomerRequestMapper($terminalKey);
    }

    /**
     * Регистрирует клиента в связке с терминалом.
     * Возможна автоматическая привязка клиента и карты, по которой был совершен платеж,
     * при передаче параметра CustomerKey в методе Init. Это можно использовать для сохранения
     * и последующего отображения клиенту замаскированного номера карты, по которой будет
     * совершен рекуррентный платеж
     * @param AddCustomerRequest $request
     * @return AddCustomerResponse
     */
    public function addCustomer(AddCustomerRequest $request): AddCustomerResponse
    {
        $data = $this->addCustomerRequestMapper->item($request);

        /**
         * @var TAddCustomer $response
         */
        $response = $this->client->execute(
            action: 'AddCustomer',
            data: $this->signatureService->signedRequest($data)
        );

        return new AddCustomerResponse(
            terminalKey: $response['TerminalKey'],
            customerKey: $response['CustomerKey'],
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null,
        );
    }

    /**
     * Возвращает данные клиента, сохраненные в связке с терминалом
     * @param CustomerRequest $request
     * @return CustomerResponse
     */
    public function customer(CustomerRequest $request): CustomerResponse
    {
        $data = $this->customerRequestMapper->item($request);

        /**
         * @var TCustomer $response
         */
        $response = $this->client->execute(
            action: 'GetCustomer',
            data: $this->signatureService->signedRequest($data)
        );

        return new CustomerResponse(
            terminalKey: $response['TerminalKey'],
            customerKey: $response['CustomerKey'],
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null,
            email: $response['Email'] ?? null,
            phone: $response['Phone'] ?? null,
        );
    }

    /**
     * Удаляет сохраненные данные клиента
     * @param RemoveCustomerRequest $request
     * @return RemoveCustomerResponse
     */
    public function removeCustomer(RemoveCustomerRequest $request): RemoveCustomerResponse
    {
        $data = $this->removeCustomerRequestMapper->item($request);

        /**
         * @var TRemoveCustomer $response
         */
        $response = $this->client->execute(
            action: 'RemoveCustomer',
            data: $this->signatureService->signedRequest($data)
        );

        return new RemoveCustomerResponse(
            terminalKey: $response['TerminalKey'],
            customerKey: $response['CustomerKey'],
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null,
        );
    }
}

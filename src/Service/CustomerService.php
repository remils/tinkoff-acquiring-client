<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\AddCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\CustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\RemoveCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Customer\AddCustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Customer\CustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Customer\RemoveCustomerResponse;

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
    public function __construct(
        protected readonly string $terminalKey,
        protected readonly TokenService $tokenService,
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
     */
    public function addCustomer(AddCustomerRequest $request): AddCustomerResponse
    {
        $data = [
            'TerminalKey' => $this->terminalKey,
            'CustomerKey' => $request->customerKey,
        ];

        if (null !== $request->email) {
            $data['Email'] = $request->email;
        }

        if (null !== $request->phone) {
            $data['Phone'] = $request->phone;
        }

        if (null !== $request->ip) {
            $data['IP'] = $request->ip;
        }

        $data['Token'] = $this->tokenService->generate($data);

        /**
         * @var TAddCustomer $response
         */
        $response = $this->client->execute('AddCustomer', $data);

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
        $data = [
            'TerminalKey' => $this->terminalKey,
            'CustomerKey' => $request->customerKey,
        ];

        if (null !== $request->ip) {
            $data['IP'] = $request->ip;
        }

        $data['Token'] = $this->tokenService->generate($data);

        /**
         * @var TCustomer $response
         */
        $response = $this->client->execute('GetCustomer', $data);

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
        $data = [
            'TerminalKey' => $this->terminalKey,
            'CustomerKey' => $request->customerKey,
        ];

        if (null !== $request->ip) {
            $data['IP'] = $request->ip;
        }

        $data['Token'] = $this->tokenService->generate($data);

        /**
         * @var TRemoveCustomer $response
         */
        $response = $this->client->execute('RemoveCustomer', $data);

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

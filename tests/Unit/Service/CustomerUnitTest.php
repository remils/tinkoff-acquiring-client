<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use SergeyZatulivetrov\TinkoffAcquiring\Service\CustomerService;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\CustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\AddCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\RemoveCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

class CustomerUnitTest extends TestCase
{
    #[Test]
    public function addCustomer(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('AddCustomer', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
                    'Email' => 'username@test.ru',
                    'Phone' => '+79031234567',
                    'IP' => '10.100.10.10',
                    'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
                ], $data);

                return [
                    'CustomerKey' => '05d65baa-9718-445e-8212-76fa0dd4c1d2',
                ];
            });

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['Token'] = '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e';

                return $data;
            });


        $request = new AddCustomerRequest(
            customerKey: '4387c647-a693-449d-bc35-91faecfc50de',
            email: 'username@test.ru',
            phone: '+79031234567',
            ip: '10.100.10.10',
        );

        $service = new CustomerService(
            terminalKey: 'TinkoffBankTest',
            signatureService: $signatureService,
            client: $client,
        );

        $response = $service->addCustomer($request);

        $this->assertEquals('05d65baa-9718-445e-8212-76fa0dd4c1d2', $response->customerKey);
    }

    #[Test]
    public function getCustomerInfo(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('GetCustomer', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
                    'IP' => '10.100.10.10',
                    'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
                ], $data);

                return [
                    'CustomerKey' => '05d65baa-9718-445e-8212-76fa0dd4c1d2',
                    'Email' => 'username@test.ru',
                    'Phone' => '+79031234567',
                ];
            });

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['Token'] = '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e';

                return $data;
            });


        $request = new CustomerRequest(
            customerKey: '4387c647-a693-449d-bc35-91faecfc50de',
            ip: '10.100.10.10',
        );

        $service = new CustomerService(
            terminalKey: 'TinkoffBankTest',
            signatureService: $signatureService,
            client: $client,
        );

        $response = $service->customer($request);

        $this->assertEquals('05d65baa-9718-445e-8212-76fa0dd4c1d2', $response->customerKey);
        $this->assertEquals('username@test.ru', $response->email);
        $this->assertEquals('+79031234567', $response->phone);
    }

    #[Test]
    public function removeCustomer(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('RemoveCustomer', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
                    'IP' => '10.100.10.10',
                    'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
                ], $data);

                return [
                    'CustomerKey' => '05d65baa-9718-445e-8212-76fa0dd4c1d2',
                ];
            });

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['Token'] = '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e';

                return $data;
            });


        $request = new RemoveCustomerRequest(
            customerKey: '4387c647-a693-449d-bc35-91faecfc50de',
            ip: '10.100.10.10',
        );

        $service = new CustomerService(
            terminalKey: 'TinkoffBankTest',
            signatureService: $signatureService,
            client: $client,
        );

        $response = $service->removeCustomer($request);

        $this->assertEquals('05d65baa-9718-445e-8212-76fa0dd4c1d2', $response->customerKey);
    }
}

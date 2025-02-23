<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Service;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\AddCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\CustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\RemoveCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Customer\AddCustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Customer\CustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Customer\RemoveCustomerResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\CustomerService;
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
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
            ]);


        $request = AddCustomerRequest::factory([
            'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
            'Email' => 'username@test.ru',
            'Phone' => '+79031234567',
            'IP' => '10.100.10.10',
        ]);

        $service = new CustomerService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $service->addCustomer($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(AddCustomerResponse::class, $response);
        $this->assertEquals([
            'CustomerKey' => '05d65baa-9718-445e-8212-76fa0dd4c1d2',
        ], $response->toArray());
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
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
            ]);


        $request = CustomerRequest::factory([
            'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
            'IP' => '10.100.10.10',
        ]);

        $service = new CustomerService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $service->customer($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(CustomerResponse::class, $response);
        $this->assertEquals([
            'CustomerKey' => '05d65baa-9718-445e-8212-76fa0dd4c1d2',
            'Email' => 'username@test.ru',
            'Phone' => '+79031234567',
        ], $response->toArray());
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
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
            ]);


        $request = RemoveCustomerRequest::factory([
            'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
            'IP' => '10.100.10.10',
        ]);

        $service = new CustomerService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $service->removeCustomer($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(RemoveCustomerResponse::class, $response);
        $this->assertEquals([
            'CustomerKey' => '05d65baa-9718-445e-8212-76fa0dd4c1d2',
        ], $response->toArray());
    }
}

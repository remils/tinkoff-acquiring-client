<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use SergeyZatulivetrov\TinkoffAcquiring\Service\PaymentService;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\InitRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\StateRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\PaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

class PaymentUnitTest extends TestCase
{
    #[Test]
    public function init(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('Init', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'OrderId' => 'autoOrd1615285401068DELb',
                    'CardId' => '67321574',
                    'Amount' => 1751,
                    'DigestValue' => 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=',
                    'SignatureValue' => 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j',
                    'X509SerialNumber' => '2613832945',
                    'DATA' => [
                        'TestKey' => 'TestValue',
                    ],
                ], $data);

                return [
                    'Status' => 'CHECKED',
                    'PaymentId' => '2353039',
                    'OrderId' => 'PaymentTestN',
                    'Amount' => 1231
                ];
            });



        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['DigestValue'] = 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=';
                $data['SignatureValue'] = 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j';
                $data['X509SerialNumber'] = '2613832945';

                return $data;
            });

        $request = new InitRequest(
            orderId: 'autoOrd1615285401068DELb',
            amount: 1751,
            cardId: '67321574',
            data: [
                'TestKey' => 'TestValue',
            ],
        );

        $paymentService = new PaymentService(
            terminalKey: 'TinkoffBankTest',
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->init($request);

        $this->assertEquals('PaymentTestN', $response->orderId);
        $this->assertEquals(PaymentStatusEnum::Checked, $response->status);
        $this->assertEquals('2353039', $response->paymentId);
        $this->assertEquals(1231, $response->amount);
    }

    #[Test]
    public function payment(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('Payment', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'PaymentId' => '700000085140',
                    'DigestValue' => 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=',
                    'SignatureValue' => 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j',
                    'X509SerialNumber' => '2613832945',
                ], $data);

                return [
                    'OrderId' => '21050',
                    'Status' => 'COMPLETED',
                    'PaymentId' => '10063',
                ];
            });

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['DigestValue'] = 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=';
                $data['SignatureValue'] = 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j';
                $data['X509SerialNumber'] = '2613832945';

                return $data;
            });

        $request = new PaymentRequest(
            paymentId: '700000085140',
        );

        $paymentService = new PaymentService(
            terminalKey: 'TinkoffBankTest',
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->payment($request);

        $this->assertEquals('21050', $response->orderId);
        $this->assertEquals(PaymentStatusEnum::Completed, $response->status);
        $this->assertEquals('10063', $response->paymentId);
    }

    #[Test]
    public function state(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('GetState', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'PaymentId' => '700000085101',
                    'DigestValue' => 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=',
                    'SignatureValue' => 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j',
                    'X509SerialNumber' => '2613832945',

                ], $data);

                return [
                    'OrderId' => '21057',
                    'Status' => 'CONFIRMED',
                    'PaymentId' => '2304882',
                    'Amount' => 1751,
                ];
            });

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['DigestValue'] = 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=';
                $data['SignatureValue'] = 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j';
                $data['X509SerialNumber'] = '2613832945';

                return $data;
            });

        $request = new StateRequest(
            paymentId: '700000085101',
        );

        $paymentService = new PaymentService(
            terminalKey: 'TinkoffBankTest',
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->state($request);

        $this->assertEquals('21057', $response->orderId);
        $this->assertEquals(PaymentStatusEnum::Confirmed, $response->status);
        $this->assertEquals('2304882', $response->paymentId);
        $this->assertEquals(1751, $response->amount);
    }
}

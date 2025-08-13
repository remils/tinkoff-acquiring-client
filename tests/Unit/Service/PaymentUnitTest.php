<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Service;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\ChargeRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\ConfirmRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\Init\InitPaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\Init\InitPayoutRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\PaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\StateRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\ChargeResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\ConfirmResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\InitResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\PaymentResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Payment\StateResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\PaymentService;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

class PaymentUnitTest extends TestCase
{
    #[Test]
    public function charge(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('Charge', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'PaymentId' => '700001702044',
                    'RebillId' => '145919',
                    'Token' => 'f5a3be479324a6d3a4d9efa0d02880b77d04a91758deddcbd9e752a6df97cab5',
                    'IP' => '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
                    'SendEmail' => true,
                    'InfoEmail' => 'customer@test.com',
                ], $data);

                return [
                    'TerminalKey' => 'TinkoffBankTest',
                    'Amount' => 100000,
                    'OrderId' => '21050',
                    'Success' => true,
                    'Status' => 'NEW',
                    'PaymentId' => '13660',
                    'ErrorCode' => '0',
                ];
            });

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'Token' => 'f5a3be479324a6d3a4d9efa0d02880b77d04a91758deddcbd9e752a6df97cab5',
            ]);

        $request = ChargeRequest::factory([
            'PaymentId' => '700001702044',
            'RebillId' => '145919',
            'IP' => '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
            'SendEmail' => true,
            'InfoEmail' => 'customer@test.com',
        ]);

        $paymentService = new PaymentService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->charge($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(ChargeResponse::class, $response);
        $this->assertEquals([
            'Amount' => 100000,
            'OrderId' => '21050',
            'Status' => 'NEW',
            'PaymentId' => '13660',
        ], $response->toArray());
    }


    #[Test]
    public function initPayout(): void
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
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'DigestValue' => 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=',
                'SignatureValue' => 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j',
                'X509SerialNumber' => '2613832945',
            ]);

        $request = InitPayoutRequest::factory([
            'OrderId' => 'autoOrd1615285401068DELb',
            'Amount' => 1751,
            'CardId' => '67321574',
            'DATA' => [
                'TestKey' => 'TestValue',
            ],
        ]);

        $paymentService = new PaymentService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->init($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(InitResponse::class, $response);
        $this->assertEquals([
            'Status' => 'CHECKED',
            'PaymentId' => '2353039',
            'OrderId' => 'PaymentTestN',
            'Amount' => 1231
        ], $response->toArray());
    }

    #[Test]
    public function initPayment(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('Init', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'Amount' => 140000,
                    'OrderId' => '21090',
                    'RedirectDueDate' => '2016-08-31T12:28:00+03:00',
                    'Descriptor' => 'DescriptorValue',
                    'Shops' => [
                        [
                            'ShopCode' => 'ShopCodeValue',
                            'Amount' => 123456789,
                            'Name' => 'NameValue',
                            'Fee' => 'FeeValue',
                        ]
                    ],
                    'Token' => 'c744b9711d978c152fb4546c6cdcec24ebd9870678f9f325a9713ca56d6a6826',
                    'Description' => 'Подписка на 1400.00 рублей',
                    'CustomerKey' => 'string',
                    'Recurrent' => 'Y',
                    'PayType' => 'O',
                    'Language' => 'ru',
                    'NotificationURL' => 'http://example.com/nURL',
                    'SuccessURL' => 'http://example.com/sURL',
                    'FailURL' => 'http://example.com/fURL',
                    'DATA' => [
                        'key' => 'value'
                    ],
                    'Receipt' => [
                        'Items' => [
                            [
                                'Name' => 'name',
                                'Price' => 123,
                                'Quantity' => 0.22,
                                'Amount' => 33,
                                'PaymentMethod' => 'advance',
                                'PaymentObject' => 'another',
                                'Tax' => 'vat10',
                                'Ean13' => 'ean13',
                                'AgentData' => [
                                    'AgentSign' => 'attorney',
                                    'OperationName' => 'operationName',
                                    'Phones' => ['phones'],
                                    'ReceiverPhones' => ['receiverPhones'],
                                    'TransferPhones' => ['transferPhones'],
                                    'OperatorName' => 'operatorName',
                                    'OperatorInn' => 'operatorInn',
                                    'OperatorAddress' => 'operatorAddress',
                                ],
                                'SupplierInfo' => [
                                    'Phones' => ['phones'],
                                    'Name' => 'name',
                                    'Inn' => 'inn'
                                ],
                                'DeclarationNumber' => 'declarationNumber',
                                'UserData' => 'userData',
                                'ShopCode' => 'shopCode',
                                'MarkQuantity' => [
                                    'Numerator' => 123,
                                    'Denominator' => 432,
                                ],
                                'SectoralItemProps' => [
                                    'FederalId' => 'federalId',
                                    'Date' => 'date',
                                    'Number' => 'number',
                                    'Value' => 'value',
                                ],
                                'CountryCode' => 'countryCode',
                                'Excise' => 'excise',
                                'MarkCode' => [
                                    'MarkCodeType' => 'EGAIS20',
                                    'Value' => 'value',
                                ],
                                'MarkProcessingMode' => 'markProcessingMode',
                                'MeasurementUnit' => 'measurementUnit',
                            ]
                        ],
                        'FfdVersion' => '1.05',
                        'Email' => 'EmailValue',
                        'Phone' => 'PhoneValue',
                        'Taxation' => 'osn',
                        'Payments' => [
                            'Cash' => 200,
                            'Electronic' => 100,
                            'AdvancePayment' => 300,
                            'Credit' => 400,
                            'Provision' => 500,
                        ],
                        'Customer' => 'CustomerValue',
                        'CustomerInn' => 'CustomerInnValue',
                        'ClientInfo' => [
                            'Address' => 'AddressValue',
                            'Birthdate' => 'BirthdateValue',
                            'Citizenship' => 'CitizenshipValue',
                            'DocumentCode' => 'DocumentCodeValue',
                            'DocumentData' => 'DocumentDataValue',
                        ],
                    ]

                ], $data);

                return [
                    'Status' => 'CHECKED',
                    'PaymentId' => '2353039',
                    'OrderId' => 'PaymentTestN',
                    'Amount' => 1231,
                    'PaymentURL' => 'paymentURL',
                ];
            });


        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'Token' => 'c744b9711d978c152fb4546c6cdcec24ebd9870678f9f325a9713ca56d6a6826',
            ]);

        $request = InitPaymentRequest::factory([
            'OrderId' => '21090',
            'Amount' => 140000,
            'DATA' => [
                'key' => 'value',
            ],
            'Description' => 'Подписка на 1400.00 рублей',
            'CustomerKey' => 'string',
            'Recurrent' => 'Y',
            'PayType' => 'O',
            'Language' => 'ru',
            'NotificationURL' => 'http://example.com/nURL',
            'SuccessURL' => 'http://example.com/sURL',
            'FailURL' => 'http://example.com/fURL',
            'RedirectDueDate' => '2016-08-31T12:28:00+03:00',
            'Receipt' => [
                'Taxation' => 'osn',
                'Items' => [
                    [
                        'Name' => 'name',
                        'Quantity' => 0.22,
                        'Amount' => 33,
                        'Price' => 123,
                        'Tax' => 'vat10',
                        'PaymentMethod' => 'advance',
                        'PaymentObject' => 'another',
                        'Ean13' => 'ean13',
                        'AgentData' => [
                            'AgentSign' => 'attorney',
                            'OperationName' => 'operationName',
                            'Phones' => ['phones'],
                            'ReceiverPhones' => ['receiverPhones'],
                            'TransferPhones' => ['transferPhones'],
                            'OperatorName' => 'operatorName',
                            'OperatorInn' => 'operatorInn',
                            'OperatorAddress' => 'operatorAddress',
                        ],
                        'SupplierInfo' => [
                            'Phones' => ['phones'],
                            'Name' => 'name',
                            'Inn' => 'inn',
                        ],
                        'MarkQuantity' => [
                            'Numerator' => 123,
                            'Denominator' => 432,
                        ],
                        'SectoralItemProps' => [
                            'FederalId' => 'federalId',
                            'Date' => 'date',
                            'Number' => 'number',
                            'Value' => 'value',
                        ],
                        'CountryCode' => 'countryCode',
                        'DeclarationNumber' => 'declarationNumber',
                        'Excise' => 'excise',
                        'MarkCode' => [
                            'MarkCodeType' => 'EGAIS20',
                            'Value' => 'value',
                        ],
                        'MarkProcessingMode' => 'markProcessingMode',
                        'MeasurementUnit' => 'measurementUnit',
                        'ShopCode' => 'shopCode',
                        'UserData' => 'userData',
                    ]
                ],
                'FfdVersion' => '1.05',
                'Email' => 'EmailValue',
                'Phone' => 'PhoneValue',
                'Payments' => [
                    'Electronic' => 100,
                    'Cash' => 200,
                    'AdvancePayment' => 300,
                    'Credit' => 400,
                    'Provision' => 500,
                ],
                'Customer' => 'CustomerValue',
                'CustomerInn' => 'CustomerInnValue',
                'ClientInfo' => [
                    'Birthdate' => 'BirthdateValue',
                    'Citizenship' => 'CitizenshipValue',
                    'DocumentCode' => 'DocumentCodeValue',
                    'DocumentData' => 'DocumentDataValue',
                    'Address' => 'AddressValue',
                ],
            ],
            'Shops' => [
                [
                    'ShopCode' => 'ShopCodeValue',
                    'Amount' => 123456789,
                    'Name' => 'NameValue',
                    'Fee' => 'FeeValue',
                ]
            ],
            'Descriptor' => 'DescriptorValue',
        ]);

        $paymentService = new PaymentService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->init($request);
        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(InitResponse::class, $response);
        $this->assertEquals([
            'Status' => 'CHECKED',
            'PaymentId' => '2353039',
            'OrderId' => 'PaymentTestN',
            'Amount' => 1231,
            'PaymentURL' => 'paymentURL',
        ], $response->toArray());
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
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'DigestValue' => 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=',
                'SignatureValue' => 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j',
                'X509SerialNumber' => '2613832945',
            ]);

        $request = PaymentRequest::factory([
            'PaymentId' => '700000085140',
        ]);

        $paymentService = new PaymentService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->payment($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(PaymentResponse::class, $response);
        $this->assertEquals([
            'OrderId' => '21050',
            'Status' => 'COMPLETED',
            'PaymentId' => '10063',
        ], $response->toArray());
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
                    'IP' => '128.0.0.8',

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
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'DigestValue' => 'qfeohMmrsEvr4QPB8CeZETb+W6VDEGnMrf+oVjvSaMU=',
                'SignatureValue' => 'rNTloWBbTsid1n9B1ANZ9/VasWJyg6jfiMeI12ERBSlOnzy6YFqMaa5nRb9ZrK9wbKimIBD70v8j',
                'X509SerialNumber' => '2613832945',
            ]);

        $request = StateRequest::factory([
            'PaymentId' => '700000085101',
            'IP' => '128.0.0.8',
        ]);

        $paymentService = new PaymentService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->state($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(StateResponse::class, $response);
        $this->assertEquals([
            'OrderId' => '21057',
            'Status' => 'CONFIRMED',
            'PaymentId' => '2304882',
            'Amount' => 1751,
        ], $response->toArray());
    }

    #[Test]
    public function confirm(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('Confirm', $action);
                $this->assertEquals([
                    'TerminalKey' => 'TinkoffBankTest',
                    'PaymentId' => '2304882',
                    'Token' => 'c0ad1dfc4e94ed44715c5ed0e84f8ec439695b9ac219a7a19555a075a3c3ed24',
                    'IP' => '192.168.255.255',
                    'Amount' => 19200,
                    'Receipt' => [
                        'FfdVersion' => 'string',
                        'ClientInfo' => [
                            'Birthdate' => 'string',
                            'Citizenship' => 'string',
                            'DocumentCode' => '21',
                            'DocumentData' => 'string',
                            'Address' => 'string'
                        ],
                        'Taxation' => 'osn',
                        'Email' => 'a@test.ru',
                        'Phone' => '+79031234567',
                        'Customer' => '78894325',
                        'CustomerInn' => '788621292',
                        'Items' => [
                            [
                                'AgentData' => [
                                    'AgentSign' => 'paying_agent',
                                    'OperationName' => 'Позиция чека',
                                    'Phones' => [
                                    '+790912312398'
                                    ],
                                    'ReceiverPhones' => [
                                        '+79221210697',
                                        '+79098561231'
                                    ],
                                    'TransferPhones' => [
                                        '+79221210697'
                                    ],
                                    'OperatorName' => 'Tinkoff',
                                    'OperatorAddress' => 'г. Тольятти',
                                    'OperatorInn' => '7710140679'
                                ],
                                'SupplierInfo' => [
                                    'Phones' => [
                                        '+79221210697',
                                        '+79098561231'
                                    ],
                                    'Name' => 'ООО Вендор товара',
                                    'Inn' => '7710140679'
                                ],
                                'Name' => 'Наименование товара 1',
                                'Price' => 10000,
                                'Quantity' => 1,
                                'Amount' => 10000,
                                'Tax' => 'vat10',
                                'PaymentMethod' => 'full_payment',
                                'PaymentObject' => 'agent_commission',
                                'UserData' => 'Данные пользователя ext.test.qa@tinkoff.ru',
                                'Excise' => '12.2',
                                'CountryCode' => '056',
                                'DeclarationNumber' => '12345678901',
                                'MeasurementUnit' => 'шт',
                                'MarkProcessingMode' => 'string',
                                'MarkCode' => [
                                    'MarkCodeType' => 'EAN8',
                                    'Value' => '12345678'
                                ],
                                'MarkQuantity' => [
                                    'Numerator' => 1,
                                    'Denominator' => 2
                                ],
                                'SectoralItemProps' => [
                                    'FederalId' => '001',
                                    'Date' => '21.11.2020',
                                    'Number' => '123/43',
                                    'Value' => 'test value SectoralItemProps'
                                ]
                            ]
                        ],
                        'Payments' => [
                            'Cash' => 90000,
                            'Electronic' => 50000,
                            'AdvancePayment' => 0,
                            'Credit' => 0,
                            'Provision' => 0
                        ]
                    ],
                    'Shops' => [
                        [
                            'ShopCode' => '700456',
                            'Amount' => 10000,
                            'Name' => 'Товар',
                            'Fee' => '500'
                        ]
                    ],
                    'Route' => 'BNPL',
                    'Source' => 'BNPL',
                ], $data);

                return [
                    'TerminalKey' => 'TinkoffBankTest',
                    'OrderId' => '21057',
                    'Success' => true,
                    'Status' => 'CONFIRMED',
                    'PaymentId' => '2304882',
                    'ErrorCode' => '0',
                    'Message' => 'OK',
                    'Details' => 'None',
                    'Params' => [
                        [
                            'Key' => 'Route',
                            'Value' => 'ACQ',
                        ],
                    ],
                ];
            });



        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturn([
                'TerminalKey' => 'TinkoffBankTest',
                'Token' => 'c0ad1dfc4e94ed44715c5ed0e84f8ec439695b9ac219a7a19555a075a3c3ed24',
            ]);

        $request = ConfirmRequest::factory([
            'PaymentId' => '2304882',
            'IP' => '192.168.255.255',
            'Amount' => 19200,
            'Receipt' => [
                'FfdVersion' => 'string',
                'ClientInfo' => [
                    'Birthdate' => 'string',
                    'Citizenship' => 'string',
                    'DocumentCode' => '21',
                    'DocumentData' => 'string',
                    'Address' => 'string'
                ],
                'Taxation' => 'osn',
                'Email' => 'a@test.ru',
                'Phone' => '+79031234567',
                'Customer' => '78894325',
                'CustomerInn' => '788621292',
                'Items' => [
                    [
                        'AgentData' => [
                            'AgentSign' => 'paying_agent',
                            'OperationName' => 'Позиция чека',
                            'Phones' => [
                            '+790912312398'
                            ],
                            'ReceiverPhones' => [
                                '+79221210697',
                                '+79098561231'
                            ],
                            'TransferPhones' => [
                                '+79221210697'
                            ],
                            'OperatorName' => 'Tinkoff',
                            'OperatorAddress' => 'г. Тольятти',
                            'OperatorInn' => '7710140679'
                        ],
                        'SupplierInfo' => [
                            'Phones' => [
                                '+79221210697',
                                '+79098561231'
                            ],
                            'Name' => 'ООО Вендор товара',
                            'Inn' => '7710140679'
                        ],
                        'Name' => 'Наименование товара 1',
                        'Price' => 10000,
                        'Quantity' => 1,
                        'Amount' => 10000,
                        'Tax' => 'vat10',
                        'PaymentMethod' => 'full_payment',
                        'PaymentObject' => 'agent_commission',
                        'UserData' => 'Данные пользователя ext.test.qa@tinkoff.ru',
                        'Excise' => '12.2',
                        'CountryCode' => '056',
                        'DeclarationNumber' => '12345678901',
                        'MeasurementUnit' => 'шт',
                        'MarkProcessingMode' => 'string',
                        'MarkCode' => [
                            'MarkCodeType' => 'EAN8',
                            'Value' => '12345678'
                        ],
                        'MarkQuantity' => [
                            'Numerator' => 1,
                            'Denominator' => 2
                        ],
                        'SectoralItemProps' => [
                            'FederalId' => '001',
                            'Date' => '21.11.2020',
                            'Number' => '123/43',
                            'Value' => 'test value SectoralItemProps'
                        ]
                    ]
                ],
                'Payments' => [
                    'Cash' => 90000,
                    'Electronic' => 50000,
                    'AdvancePayment' => 0,
                    'Credit' => 0,
                    'Provision' => 0
                ]
            ],
            'Shops' => [
                [
                    'ShopCode' => '700456',
                    'Amount' => 10000,
                    'Name' => 'Товар',
                    'Fee' => '500'
                ]
            ],
            'Route' => 'BNPL',
            'Source' => 'BNPL',
        ]);

        $paymentService = new PaymentService(
            signatureService: $signatureService,
            client: $client,
        );

        $response = $paymentService->confirm($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(ConfirmResponse::class, $response);
        $this->assertEquals([
            'OrderId' => '21057',
            'Status' => 'CONFIRMED',
            'PaymentId' => '2304882',
            'Params' => [
                [
                    'Key' => 'Route',
                    'Value' => 'ACQ',
                ],
            ],
        ], $response->toArray());
    }
}

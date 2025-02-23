<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Card;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardTypeEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CheckTypeEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Service\CardService;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\AddCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\CardListRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\AddCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\RemoveCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\CardListResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\RemoveCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

class CardUnitTest extends TestCase
{
    #[Test]
    public function addCard(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturn([
                'TerminalKey' => '1111133333',
                'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
            ]);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('AddCard', $action);

                $this->assertEquals([
                    'TerminalKey' => '1111133333',
                    'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
                    'CustomerKey' => 'testCustomer1234',
                    'IP' => '10.100.10.10',
                    'CheckType' => 'NO',
                    'ResidentState' => true,
                ], $data);

                return [
                    'PaymentId' => '6155312072',
                    'TerminalKey' => 'TinkoffBankTest',
                    'CustomerKey' => '906540',
                    'RequestKey' => 'ed989549-d3be-4758-95c7-22647e03f9ec',
                    'ErrorCode' => '0',
                    'Success' => true,
                    'Message' => 'Неверные параметры',
                    'Details' => 'Терминал не найден',
                    'PaymentURL' => '82a31a62-6067-4ad8-b379-04bf13e37642d',
                ];
            });

        $service = new CardService(
            signatureService: $signatureService,
            client: $client,
        );

        $request = AddCardRequest::factory([
            'CustomerKey' => 'testCustomer1234',
            'CheckType' => 'NO',
            'ResidentState' => true,
            'IP' => '10.100.10.10',
        ]);

        $response = $service->addCard($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(AddCardResponse::class, $response);

        $this->assertEquals([
            'PaymentId' => '6155312072',
            'CustomerKey' => '906540',
            'RequestKey' => 'ed989549-d3be-4758-95c7-22647e03f9ec',
            'PaymentURL' => '82a31a62-6067-4ad8-b379-04bf13e37642d',
        ], $response->toArray());
    }

    #[Test]
    public function removeCard(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturn([
                'TerminalKey' => 'testRegressBank',
                'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
            ]);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('RemoveCard', $action);

                $this->assertEquals([
                    'TerminalKey' => 'testRegressBank',
                    'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
                    'CustomerKey' => 'testCustomer1234',
                    'IP' => '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
                    'CardId' => '156516516',
                ], $data);

                return [
                    'TerminalKey' => 'TinkoffBankTest',
                    'Status' => 'D',
                    'CustomerKey' => 'testCustomer1234',
                    'CardId' => '156516516',
                    'CardType' => 0,
                    'Success' => true,
                    'ErrorCode' => '0',
                    'Message' => 'Неверные параметры',
                    'Details' => 'Не удалось удалить карту клиента, для данного клиента такая карта не существует',
                ];
            });


        $service = new CardService(
            signatureService: $signatureService,
            client: $client,
        );

        $request = RemoveCardRequest::factory([
            'CustomerKey' => 'testCustomer1234',
            'CardId' => '156516516',
            'IP' => '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
        ]);

        $response = $service->removeCard($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(RemoveCardResponse::class, $response);
        $this->assertEquals([
            'Status' => 'D',
            'CustomerKey' => 'testCustomer1234',
            'CardId' => '156516516',
            'CardType' => 0,
        ], $response->toArray());
    }

    #[Test]
    public function cardList(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturn([
                'TerminalKey' => 'testRegressBank',
                'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
            ]);

        $client->method('execute')
            ->willReturnCallback(function (string $action, array $data): array {
                $this->assertEquals('GetCardList', $action);

                $this->assertEquals([
                    'TerminalKey' => 'testRegressBank',
                    'CustomerKey' => 'testCustomer1234',
                    'Token' => '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e',
                    'SavedCard' => true,
                    'IP' => '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
                ], $data);

                return [
                    [
                        'CardId' => '881900',
                        'Pan' => '518223******0036',
                        'Status' => 'D',
                        'RebillId' => '6155312073',
                        'CardType' => 0,
                        'ExpDate' => '1122'
                    ]
                ];
            });


        $service = new CardService(
            signatureService: $signatureService,
            client: $client,
        );

        $request = CardListRequest::factory([
            'CustomerKey' => 'testCustomer1234',
            'SavedCard' => true,
            'IP' => '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
        ]);

        $response = $service->cardList($request);

        $this->assertInstanceOf(ComponentInterface::class, $response);
        $this->assertInstanceOf(CardListResponse::class, $response);

        $this->assertEquals([
            [
                'CardId' => '881900',
                'Pan' => '518223******0036',
                'Status' => 'D',
                'RebillId' => '6155312073',
                'CardType' => 0,
                'ExpDate' => '1122'
            ],
        ], $response->toArray());
    }
}

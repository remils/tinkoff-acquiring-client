<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Service;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Entity\Card\Card;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardTypeEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CheckTypeEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\AddCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\CardListRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\RemoveCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\AddCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\CardListResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\RemoveCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\CardService;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

class CardUnitTest extends TestCase
{
    #[Test]
    public function addCard(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['Token'] = '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e';

                return $data;
            });

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
            terminalKey: '1111133333',
            signatureService: $signatureService,
            client: $client,
        );

        $request = new AddCardRequest(
            customerKey: 'testCustomer1234',
            checkType: CheckTypeEnum::No,
            residentState: true,
            ip: '10.100.10.10',
        );

        $response = $service->addCard($request);

        $this->assertInstanceOf(AddCardResponse::class, $response);

        $this->assertEquals('6155312072', $response->paymentId);
        $this->assertEquals('906540', $response->customerKey);
        $this->assertEquals('ed989549-d3be-4758-95c7-22647e03f9ec', $response->requestKey);
        $this->assertEquals('82a31a62-6067-4ad8-b379-04bf13e37642d', $response->paymentUrl);
    }

    #[Test]
    public function removeCard(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['Token'] = '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e';

                return $data;
            });

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
            terminalKey: 'testRegressBank',
            signatureService: $signatureService,
            client: $client,
        );

        $request = new RemoveCardRequest(
            customerKey: 'testCustomer1234',
            cardId: '156516516',
            ip: '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
        );

        $response = $service->removeCard($request);

        $this->assertInstanceOf(RemoveCardResponse::class, $response);

        $this->assertEquals(CardStatusEnum::Deleted, $response->status);
        $this->assertEquals('testCustomer1234', $response->customerKey);
        $this->assertEquals('156516516', $response->cardId);
        $this->assertEquals(CardTypeEnum::Debiting, $response->cardType);
    }

    #[Test]
    public function cardList(): void
    {
        $client = $this->createMock(ClientInterface::class);

        $signatureService = $this->createMock(SignatureServiceInterface::class);

        $signatureService->method('signedRequest')
            ->willReturnCallback(function (array $data): array {
                $data['Token'] = '30797e66108934dfa3d841b856fdad227c6b9c46d6a39296e02dc800d86d181e';

                return $data;
            });

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
            terminalKey: 'testRegressBank',
            signatureService: $signatureService,
            client: $client,
        );

        $request = new CardListRequest(
            customerKey: 'testCustomer1234',
            savedCard: true,
            ip: '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
        );

        $response = $service->cardList($request);

        $this->assertInstanceOf(CardListResponse::class, $response);
        $this->assertInstanceOf(Card::class, $response->items[0]);

        $this->assertEquals('881900', $response->items[0]->cardId);
        $this->assertEquals('518223******0036', $response->items[0]->pan);
        $this->assertEquals(CardStatusEnum::Deleted, $response->items[0]->status);
        $this->assertEquals(CardTypeEnum::Debiting, $response->items[0]->cardType);
        $this->assertEquals('6155312073', $response->items[0]->rebillId);
        $this->assertEquals('1122', $response->items[0]->expDate);
    }
}

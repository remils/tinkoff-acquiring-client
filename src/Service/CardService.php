<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Factory\Card\AddCardResponseFactory;
use SergeyZatulivetrov\TinkoffAcquiring\Factory\Card\CardListResponseFactory;
use SergeyZatulivetrov\TinkoffAcquiring\Factory\Card\RemoveCardResponseFactory;
use SergeyZatulivetrov\TinkoffAcquiring\Mapper\Card\AddCardRequestMapper;
use SergeyZatulivetrov\TinkoffAcquiring\Mapper\Card\CardListRequestMapper;
use SergeyZatulivetrov\TinkoffAcquiring\Mapper\Card\RemoveCardRequestMapper;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\AddCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\CardListRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\RemoveCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\AddCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\CardListResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\RemoveCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CardService
 */
class CardService
{
    protected readonly AddCardRequestMapper $addCardRequestMapper;

    protected readonly CardListRequestMapper $cardListRequestMapper;

    protected readonly RemoveCardRequestMapper $removeCardRequestMapper;

    public function __construct(
        protected readonly string $terminalKey,
        protected readonly SignatureServiceInterface $signatureService,
        protected readonly ClientInterface $client,
    ) {
        $this->addCardRequestMapper = new AddCardRequestMapper($terminalKey);
        $this->cardListRequestMapper = new CardListRequestMapper($terminalKey);
        $this->removeCardRequestMapper = new RemoveCardRequestMapper($terminalKey);
    }

    /**
     * Сохраняет карту клиента. В случае успешной привязки переадресует клиента на Success Add Card URL,
     * а в противном случае на Fail Add Card URL
     * @param AddCardRequest $request
     * @return AddCardResponse
     */
    public function addCard(AddCardRequest $request): AddCardResponse
    {
        $data = $this->addCardRequestMapper->item($request);

        $response = $this->client->execute(
            action: 'AddCard',
            data: $this->signatureService->signedRequest($data),
        );

        return AddCardResponseFactory::fromArray($response);
    }


    /**
     * Возвращает список всех привязанных карт клиента, включая удаленные
     * @param CardListRequest $request
     * @return CardListResponse
     */
    public function cardList(CardListRequest $request): CardListResponse
    {
        $data = $this->cardListRequestMapper->item($request);

        $response = $this->client->execute(
            action: 'GetCardList',
            data: $this->signatureService->signedRequest($data),
        );

        if (array_is_list($response)) {
            return CardListResponseFactory::fromArray($response);
        }

        return CardListResponseFactory::failFromArray($response);
    }

    /**
     * Удаляет привязанную карту клиента
     * @param RemoveCardRequest $request
     * @return RemoveCardResponse
     */
    public function removeCard(RemoveCardRequest $request): RemoveCardResponse
    {
        $data = $this->removeCardRequestMapper->item($request);

        $response = $this->client->execute(
            action: 'RemoveCard',
            data: $this->signatureService->signedRequest($data),
        );

        return RemoveCardResponseFactory::fromArray($response);
    }
}

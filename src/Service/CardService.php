<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\AddCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\CardListRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\RemoveCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\AddCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\CardListResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\RemoveCardResponse;

/**
 * CardService
 *
 * @phpstan-template TSignatureData of array<string,string>
 * @phpstan-extends AbstractService<TSignatureData>
 */
class CardService extends AbstractService
{
    /**
     * Сохраняет карту клиента. В случае успешной привязки переадресует клиента на Success Add Card URL,
     * а в противном случае на Fail Add Card URL
     * @param AddCardRequest $request
     * @return AddCardResponse
     * @throws TinkoffException|HttpException
     */
    public function addCard(AddCardRequest $request): AddCardResponse
    {
        $response = $this->client->execute(
            action: 'AddCard',
            data: $this->signedRequest($request->toArray()),
        );

        return AddCardResponse::factory($response);
    }

    /**
     * Возвращает список всех привязанных карт клиента, включая удаленные
     * @param CardListRequest $request
     * @return CardListResponse
     * @throws TinkoffException|HttpException
     */
    public function cardList(CardListRequest $request): CardListResponse
    {
        $response = $this->client->execute(
            action: 'GetCardList',
            data: $this->signedRequest($request->toArray()),
        );

        return CardListResponse::factory($response);
    }

    /**
     * Удаляет привязанную карту клиента
     * @param RemoveCardRequest $request
     * @return RemoveCardResponse
     * @throws TinkoffException|HttpException
     */
    public function removeCard(RemoveCardRequest $request): RemoveCardResponse
    {
        $response = $this->client->execute(
            action: 'RemoveCard',
            data: $this->signedRequest($request->toArray()),
        );

        return RemoveCardResponse::factory($response);
    }
}

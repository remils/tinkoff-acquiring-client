<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
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
    public function __construct(
        protected readonly string $terminalKey,
        protected readonly SignatureServiceInterface $signatureService,
        protected readonly ClientInterface $client,
    ) {
    }

    /**
     * Сохраняет карту клиента. В случае успешной привязки переадресует клиента на Success Add Card URL,
     * а в противном случае на Fail Add Card URL
     * @param AddCardRequest $request
     * @return AddCardResponse
     */
    public function addCard(AddCardRequest $request): AddCardResponse
    {
        $response = $this->client->execute(
            action: 'AddCard',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return AddCardResponse::fromArray($response);
    }


    /**
     * Возвращает список всех привязанных карт клиента, включая удаленные
     * @param CardListRequest $request
     * @return CardListResponse
     */
    public function cardList(CardListRequest $request): CardListResponse
    {
        $response = $this->client->execute(
            action: 'GetCardList',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        if (array_is_list($response)) {
            return CardListResponse::listFromArray($response);
        }

        return CardListResponse::failFromArray($response);
    }

    /**
     * Удаляет привязанную карту клиента
     * @param RemoveCardRequest $request
     * @return RemoveCardResponse
     */
    public function removeCard(RemoveCardRequest $request): RemoveCardResponse
    {
        $response = $this->client->execute(
            action: 'RemoveCard',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return RemoveCardResponse::fromArray($response);
    }
}

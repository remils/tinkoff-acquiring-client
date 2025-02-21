<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\AddCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\CardListResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\RemoveCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\AddCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\CardListRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\RemoveCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CardService
 *
 * @template TSignatureData of array<string,string>
 */
class CardService
{
    /**
     * @param string $terminalKey
     * @param SignatureServiceInterface<TSignatureData> $signatureService
     * @param ClientInterface $client
     */
    public function __construct(
        protected readonly string $terminalKey,
        protected readonly SignatureServiceInterface $signatureService,
        protected readonly ClientInterface $client,
    ) {
    }

    /**
     * Сохраняет карту клиента. В случае успешной привязки переадресует клиента на Success Add Card URL,
     * а в противном случае на Fail Add Card URL
     * @param AddCardRequest<TSignatureData> $request
     * @return AddCardResponse
     * @throws TinkoffException|HttpException
     */
    public function addCard(AddCardRequest $request): AddCardResponse
    {
        $response = $this->client->execute(
            action: 'AddCard',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return AddCardResponse::factory($response);
    }

    /**
     * Возвращает список всех привязанных карт клиента, включая удаленные
     * @param CardListRequest<TSignatureData> $request
     * @return CardListResponse
     * @throws TinkoffException|HttpException
     */
    public function cardList(CardListRequest $request): CardListResponse
    {
        $response = $this->client->execute(
            action: 'GetCardList',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return CardListResponse::factory($response);
    }

    /**
     * Удаляет привязанную карту клиента
     * @param RemoveCardRequest<TSignatureData> $request
     * @return RemoveCardResponse
     * @throws TinkoffException|HttpException
     */
    public function removeCard(RemoveCardRequest $request): RemoveCardResponse
    {
        $response = $this->client->execute(
            action: 'RemoveCard',
            data: $request->build($this->terminalKey, $this->signatureService),
        );

        return RemoveCardResponse::factory($response);
    }
}

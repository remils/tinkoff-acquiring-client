<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\AddCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\CardListRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\RemoveCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\AddCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\CardListResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Response\Card\RemoveCardResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CardService
 *
 * @phpstan-template TSignatureData of array<string,string>
 */
class CardService
{
    /**
     * @param SignatureServiceInterface<TSignatureData> $signatureService
     * @param ClientInterface $client
     */
    public function __construct(
        protected readonly SignatureServiceInterface $signatureService,
        protected readonly ClientInterface $client,
    ) {
    }

    /**
     * Сохраняет карту клиента. В случае успешной привязки переадресует клиента на Success Add Card URL,
     * а в противном случае на Fail Add Card URL
     * @param AddCardRequest $request
     * @return AddCardResponse
     * @throws TinkoffException|HttpException
     */
    public function addCard(AddCardRequest $request): AddCardResponse
    {
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'AddCard',
            data: array_merge($signatureData, $data),
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
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'GetCardList',
            data: array_merge($signatureData, $data),
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
        $data = $request->toArray();

        $signatureData = $this->signatureService->signedRequest($data);

        $response = $this->client->execute(
            action: 'RemoveCard',
            data: array_merge($signatureData, $data),
        );

        return RemoveCardResponse::factory($response);
    }
}

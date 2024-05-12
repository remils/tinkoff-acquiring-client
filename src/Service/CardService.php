<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Entity\CardItem;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\CardListRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\RemoveCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\CardListResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Card\RemoveCardResponse;

/**
 * CardService
 *
 * @phpstan-type TCardItem array{
 *      CardId: string,
 *      Pan: string,
 *      Status: string,
 *      CardType: int,
 *      RebillId: string,
 *      ExpDate: string
 * }
 *
 * @phpstan-type TCardListError array{
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string,
 *      Details: string
 * }
 *
 * @phpstan-type TRemoveCard array{
 *      TerminalKey: string,
 *      Status: string,
 *      CustomerKey: string,
 *      CardId: string,
 *      CardType: int,
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string,
 *      Details: string
 * }
 */
class CardService
{
    public function __construct(
        protected readonly string $terminalKey,
        protected readonly TokenService $tokenService,
        protected readonly ClientInterface $client,
    ) {
    }

    /**
     * Возвращает список всех привязанных карт клиента, включая удаленные
     * @param CardListRequest $request
     * @return CardListResponse
     */
    public function cardList(CardListRequest $request): CardListResponse
    {
        $data = [
            'TerminalKey' => $this->terminalKey,
            'CustomerKey' => $request->customerKey,
        ];

        if (null !== $request->savedCard) {
            $data['SavedCard'] = $request->savedCard;
        }

        if (null !== $request->ip) {
            $data['IP'] = $request->ip;
        }

        $data['Token'] = $this->tokenService->generate($data);

        /**
         * @var TCardItem[]|TCardListError $response
         */
        $response = $this->client->execute('GetCardList', $data);

        $items = [];

        if (array_is_list($response)) {
            foreach ($response as $item) {
                $items[] = new CardItem(
                    cardId: $item['CardId'],
                    pan: $item['Pan'],
                    status: $item['Status'],
                    cardType: $item['CardType'],
                    rebillId: $item['RebillId'] ?? null,
                    expDate: $item['ExpDate'] ?? null,
                );
            }
        }

        return new CardListResponse(
            items: $items,
            success: $response['Success'] ?? true,
            errorCode: $response['ErrorCode'] ?? '0',
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null,
        );
    }

    /**
     * Удаляет привязанную карту клиента
     * @param RemoveCardRequest $request
     * @return RemoveCardResponse
     */
    public function removeCard(RemoveCardRequest $request): RemoveCardResponse
    {
        $data = [
            'TerminalKey' => $this->terminalKey,
            'CustomerKey' => $request->customerKey,
            'CardId' => $request->cardId,
        ];

        if (null !== $request->ip) {
            $data['IP'] = $request->ip;
        }

        $data['Token'] = $this->tokenService->generate($data);

        /**
         * @var TRemoveCard $response
         */
        $response = $this->client->execute('RemoveCard', $data);

        return new RemoveCardResponse(
            terminalKey: $response['TerminalKey'],
            status: $response['Status'],
            customerKey: $response['CustomerKey'],
            cardId: $response['CardId'],
            cardType: $response['CardType'],
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null,
        );
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\CardListRequest;

/**
 * CardListRequestMapper
 *
 * @phpstan-type TItem array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      IP: string|null,
 *      SavedCard: bool|null
 * }
 */
class CardListRequestMapper
{
    public function __construct(
        protected readonly string $terminalKey,
    ) {
    }

    /**
     * @param CardListRequest $request
     * @return TItem
     */
    public function item(CardListRequest $request)
    {
        /**
         * @var TItem $data
         */
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

        return $data;
    }
}

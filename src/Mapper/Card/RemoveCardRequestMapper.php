<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\RemoveCardRequest;

/**
 * RemoveCardRequestMapper
 *
 * @phpstan-type TItem array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      CardId: string,
 *      IP: string|null
 * }
 */
class RemoveCardRequestMapper
{
    public function __construct(
        protected readonly string $terminalKey,
    ) {
    }

    /**
     * @param RemoveCardRequest $request
     * @return TItem
     */
    public function item(RemoveCardRequest $request)
    {
        /**
         * @var TItem $data
         */
        $data = [
            'TerminalKey' => $this->terminalKey,
            'CustomerKey' => $request->customerKey,
            'CardId' => $request->cardId,
        ];

        if (null !== $request->ip) {
            $data['IP'] = $request->ip;
        }

        return $data;
    }
}

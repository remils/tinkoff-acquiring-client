<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Request\Card\AddCardRequest;

/**
 * AddCardRequestMapper
 *
 * @phpstan-type TItem array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      IP: string|null,
 *      CheckType: string|null,
 *      ResidentState: bool|null
 * }
 */
class AddCardRequestMapper
{
    public function __construct(
        protected readonly string $terminalKey,
    ) {
    }

    /**
     * @param AddCardRequest $request
     * @return TItem
     */
    public function item(AddCardRequest $request)
    {
        /**
         * @var TItem $data
         */
        $data = [
            'TerminalKey' => $this->terminalKey,
            'CustomerKey' => $request->customerKey,
        ];

        if (null !== $request->ip) {
            $data['IP'] = $request->ip;
        }

        if (null !== $request->checkType) {
            $data['CheckType'] = $request->checkType->value;
        }

        if (null !== $request->residentState) {
            $data['ResidentState'] = $request->residentState;
        }

        return $data;
    }
}

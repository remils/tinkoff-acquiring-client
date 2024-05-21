<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\CustomerRequest;

/**
 * CustomerRequestMapper
 *
 * @phpstan-type TItem array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      IP: string|null
 * }
 */
class CustomerRequestMapper
{
    public function __construct(
        protected readonly string $terminalKey,
    ) {
    }

    /**
     * @param CustomerRequest $request
     * @return TItem
     */
    public function item(CustomerRequest $request)
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

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\RemoveCustomerRequest;

/**
 * RemoveCustomerRequestMapper
 *
 * @phpstan-type TItem array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      IP: string|null
 * }
 */
class RemoveCustomerRequestMapper
{
    public function __construct(
        protected readonly string $terminalKey,
    ) {
    }

    /**
     * @param RemoveCustomerRequest $request
     * @return TItem
     */
    public function item(RemoveCustomerRequest $request)
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

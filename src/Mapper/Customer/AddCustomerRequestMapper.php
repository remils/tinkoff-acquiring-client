<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Request\Customer\AddCustomerRequest;

/**
 * AddCustomerRequestMapper
 *
 * @phpstan-type TItem array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      Email: string|null,
 *      Phone: string|null,
 *      IP: string|null
 * }
 */
class AddCustomerRequestMapper
{
    public function __construct(
        protected readonly string $terminalKey,
    ) {
    }

    /**
     * @param AddCustomerRequest $request
     * @return TItem
     */
    public function item(AddCustomerRequest $request)
    {
        /**
         * @var TItem $data
         */
        $data = [
            'TerminalKey' => $this->terminalKey,
            'CustomerKey' => $request->customerKey,
        ];

        if (null !== $request->email) {
            $data['Email'] = $request->email;
        }

        if (null !== $request->phone) {
            $data['Phone'] = $request->phone;
        }

        if (null !== $request->ip) {
            $data['IP'] = $request->ip;
        }

        return $data;
    }
}

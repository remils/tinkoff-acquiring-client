<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Customer;

use SergeyZatulivetrov\TinkoffAcquiring\Request\RequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * AddCustomerRequest
 *
 * @phpstan-type T array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      Email: string|null,
 *      Phone: string|null,
 *      IP: string|null
 * }
 *
 * @implements RequestInterface<T>
 */
class AddCustomerRequest implements RequestInterface
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string|null $email Email клиента
     * @param string|null $phone Телефон клиента в формате +{Ц}
     * @param string|null $ip IP-адрес запроса
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $ip = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function build(string $terminalKey, SignatureServiceInterface $signatureService)
    {
        /**
         * @var T $data
         */
        $data = [
            'TerminalKey' => $terminalKey,
            'CustomerKey' => $this->customerKey,
        ];

        if (null !== $this->email) {
            $data['Email'] = $this->email;
        }

        if (null !== $this->phone) {
            $data['Phone'] = $this->phone;
        }

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        return $signatureService->signedRequest($data);
    }
}

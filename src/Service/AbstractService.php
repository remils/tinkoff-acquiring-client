<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * AbstractService
 *
 * @phpstan-template TSignatureData of array<string,string>
 * @phpstan-type TData array<string,mixed>
 */
abstract class AbstractService
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
     * @param TData $data
     * @return TData&TSignatureData
     */
    protected function signedRequest(array $data): array
    {
        return array_merge($data, $this->signatureService->signedRequest($data));
    }
}

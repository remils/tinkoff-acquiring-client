<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service\Signature;

/**
 * SignatureServiceInterface
 *
 * @template TSignatureData of array<string,string>
 */
interface SignatureServiceInterface
{
    /**
     * Возвращает подписанный запрос.
     *
     * @template TData of array<string,mixed>
     *
     * @param TData $data
     * @return TData&TSignatureData
     */
    public function signedRequest(array $data): array;
}

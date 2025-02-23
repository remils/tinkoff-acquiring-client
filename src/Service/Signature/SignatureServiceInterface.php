<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service\Signature;

/**
 * SignatureServiceInterface
 *
 * @phpstan-template T of array<string,string>
 */
interface SignatureServiceInterface
{
    /**
     * Возвращает подписанный запрос
     *
     * @param array<mixed> $data
     * @return T
     */
    public function signedRequest(array $data): array;
}

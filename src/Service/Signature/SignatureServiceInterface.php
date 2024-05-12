<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service\Signature;

/**
 * SignatureServiceInterface
 */
interface SignatureServiceInterface
{
    /**
     * Возвращает подписанный запрос.
     * @param array<string,mixed> $data
     * @return array<string,mixed>
     */
    public function signedRequest(array $data): array;
}

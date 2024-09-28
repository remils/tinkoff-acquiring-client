<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * RequestInterface
 *
 * @template TData of array<string,mixed>
 * @template TSignatureData of array<string,string>
 */
interface RequestInterface
{
    /**
     * Собирает и подписывает запрос
     *
     * @param string $terminalKey
     * @param SignatureServiceInterface<TSignatureData> $signatureService
     * @return TData&TSignatureData
     */
    public function build(string $terminalKey, SignatureServiceInterface $signatureService);
}

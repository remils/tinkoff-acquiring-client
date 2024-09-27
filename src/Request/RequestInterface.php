<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * @template T
 */
interface RequestInterface
{
    /**
     * Собирает и подписывает запрос
     *
     * @param string $terminalKey
     * @param SignatureServiceInterface $signatureService
     * @return T
     */
    public function build(string $terminalKey, SignatureServiceInterface $signatureService);
}

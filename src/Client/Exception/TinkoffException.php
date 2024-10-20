<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Client\Exception;

use Exception;

/**
 * TinkoffException
 */
class TinkoffException extends Exception
{
    public function __construct(
        int $code,
        string $message,
        protected readonly string $details
    ) {
        parent::__construct($message, $code);
    }

    public function getDetails(): string
    {
        return $this->details;
    }
}

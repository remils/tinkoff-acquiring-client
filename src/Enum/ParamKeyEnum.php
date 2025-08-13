<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * ParamKeyEnum
 */
enum ParamKeyEnum: string
{
    case Route = 'Route';
    case Source = 'Source';
    case CreditAmount = 'CreditAmount';
}

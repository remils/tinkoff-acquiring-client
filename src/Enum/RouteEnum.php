<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * RouteEnum
 *
 * Способ платежа
 */
enum RouteEnum: string
{
    case Acq = 'ACQ';
    case Bnpl = 'BNPL';
    case Sber = 'SBER';
    case Tcb = 'TCB';
}

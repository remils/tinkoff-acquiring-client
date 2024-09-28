<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * CheckTypeEnum
 */
enum CheckTypeEnum: string
{
    case No = 'NO';
    case Hold = 'HOLD';
    case Secure = '3DS';
    case SecureHold = '3DSHOLD';
}

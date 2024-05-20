<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * CheckTypeEnum
 */
enum CheckTypeEnum: string
{
    case NO = 'NO';
    case HOLD = 'HOLD';
    case SECURE = '3DS';
    case SECURE_HOLD = '3DSHOLD';
}

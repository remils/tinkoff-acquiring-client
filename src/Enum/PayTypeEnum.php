<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * PaymentTypeEnum
 */
enum PayTypeEnum: string
{
    case OneStep = "O";
    case TwoStep = "T";
}

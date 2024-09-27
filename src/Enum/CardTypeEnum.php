<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

enum CardTypeEnum: int
{
    case Debiting = 0;
    case Replenishment = 1;
    case DebitingAndReplenishment = 2;
}

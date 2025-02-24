<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

enum CardStatusEnum: string
{
    case Enabled = 'A';
    case Disabled = 'I';
    case Deleted = 'D';
}

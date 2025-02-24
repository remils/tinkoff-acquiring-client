<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * VatEnum
 */
enum VatEnum: string
{
    case None = 'none';
    case Vat0 = 'vat0';
    case Vat10 = 'vat10';
    case Vat20 = 'vat20';
    case Vat110 = 'vat110';
    case Vat120 = 'vat120';
}

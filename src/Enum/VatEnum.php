<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * VatEnum
 */
enum VatEnum: string
{
    case NONE = 'none';
    case VAT0 = 'vat0';
    case VAT10 = 'vat10';
    case VAT20 = 'vat20';
    case VAT110 = 'vat110';
    case VAT120 = 'vat120';
}

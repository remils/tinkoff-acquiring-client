<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

class Vat
{
    const NONE   = 'none';   // Без НДС
    const VAT0   = 'vat0';   // НДС 0%
    const VAT10  = 'vat10';  // НДС 10%
    const VAT20  = 'vat20';  // НДС 20%
    const VAT110 = 'vat110'; // 10/110
    const VAT120 = 'vat120'; // 20/120
}

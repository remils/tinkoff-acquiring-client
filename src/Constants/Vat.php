<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

class Vat
{
    const none  = 'none'; // Без НДС
    const vat0  = 'vat0'; // НДС 0%
    const vat10 = 'vat10';// НДС 10%
    const vat20 = 'vat20'; // НДС 20%
    const vat110 = 'vat110'; // 10/110
    const vat120 = 'vat120'; // 20/120
}
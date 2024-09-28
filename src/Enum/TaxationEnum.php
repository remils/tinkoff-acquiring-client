<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * TaxationEnum
 */
enum TaxationEnum: string
{
    case Osn = 'osn';
    case UsnIncome = 'usn_income';
    case UsnIncomeOutcome = 'usn_income_outcome';
    case Patent = 'patent';
    case Envd = 'envd';
    case Esn = 'esn';
}

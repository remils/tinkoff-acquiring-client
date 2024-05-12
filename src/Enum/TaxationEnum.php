<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * TaxationEnum
 */
enum TaxationEnum: string
{
    case OSN = 'osn';
    case USN_INCOME = 'usn_income';
    case USN_INCOME_OUTCOME = 'usn_income_outcome';
    case PATENT = 'patent';
    case ENVD = 'envd';
    case ESN = 'esn';
}

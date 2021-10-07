<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

class Taxation
{
    const OSN                = 'osn';                // Общая СН
    const USN_INCOME         = 'usn_income';         // Упрощенная СН (доходы)
    const USN_INCOME_OUTCOME = 'usn_income_outcome'; // Упрощенная СН (доходы минус расходы)
    const ENVD               = 'envd';               // Единый налог на вмененный доход
    const ESN                = 'esn';                // Единый сельскохозяйственный налог
    const PATENT             = 'patent';             // Патентная СН
}

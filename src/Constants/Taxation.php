<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

class Taxation
{
    const    osn                = 'osn';                // Общая СН
    const    usn_income         = 'usn_income';         // Упрощенная СН (доходы)
    const    usn_income_outcome = 'usn_income_outcome'; // Упрощенная СН (доходы минус расходы)
    const    envd               = 'envd';               // Единый налог на вмененный доход
    const    esn                = 'esn';                // Единый сельскохозяйственный налог
    const    patent             = 'patent';             // Патентная СН
}
<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

/**
 * Taxation system
 */
class Taxation
{
    /** General */
    public const OSN = 'osn';

    /** Simplified (income) */
    public const USN_INCOME = 'usn_income';

    /** Simplified (income minus costs) */
    public const USN_INCOME_OUTCOME = 'usn_income_outcome';

    /** Patent */
    public const PATENT = 'patent';

    /** A single tax on imputed income */
    public const ENVD = 'envd';

    /** Single agricultural tax */
    public const ESN = 'esn';
}

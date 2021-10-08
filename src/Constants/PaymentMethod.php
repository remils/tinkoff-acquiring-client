<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

/**
 * Sign of payment method
 */
class PaymentMethod
{
    /** Prepay 100% */
    public const FULL_PREPAYMENT = 'full_prepayment';

    /** Prepayment */
    public const PREPAYMENT = 'prepayment';

    /** Avanc */
    public const ADVANCE = 'advance';

    /** Full calculation */
    public const FULL_PAYMENT = 'full_payment';

    /** Partial calculation and credit */
    public const PARTIAL_PAYMENT = 'partial_payment';

    /** Transfer to Credit */
    public const CREDIT = 'credit';

    /** Payment of credit */
    public const CREDIT_PAYMENT = 'credit_payment';
}

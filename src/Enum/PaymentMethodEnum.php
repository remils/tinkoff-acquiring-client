<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * PaymentMethodEnum
 */
enum PaymentMethodEnum: string
{
    case FullPrepayment = 'full_prepayment';
    case Prepayment = 'prepayment';
    case Advance = 'advance';
    case FullPayment = 'full_payment';
    case PartialPayment = 'partial_payment';
    case Credit = 'credit';
    case CreditPayment = 'credit_payment';
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

class PaymentMethod
{
    const FULL_PREPAYMENT = 'full_prepayment'; // Предоплата 100%
    const PREPAYMENT      = 'prepayment';      // Предоплата
    const ADVANCE         = 'advance';         // Аванc
    const FULL_PAYMENT    = 'full_payment';    // Полный расчет
    const PARTIAL_PAYMENT = 'partial_payment'; // Частичный расчет и кредит
    const CREDIT          = 'credit';          // Передача в кредит
    const CREDIT_PAYMENT  = 'credit_payment';  // Оплата кредита
}

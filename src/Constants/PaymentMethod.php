<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

class PaymentMethod
{
    const full_prepayment = 'full_prepayment'; //Предоплата 100%
    const prepayment      = 'prepayment';      //Предоплата
    const advance         = 'advance';         //Аванc
    const full_payment    = 'full_payment';    //Полный расчет
    const partial_payment = 'partial_payment'; //Частичный расчет и кредит
    const credit          = 'credit';          //Передача в кредит
    const credit_payment  = 'credit_payment';  //Оплата кредита
}
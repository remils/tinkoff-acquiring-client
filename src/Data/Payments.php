<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Object with payment sum of the amount of payment
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/init-request/#Payments
 *
 * @property int $Cash           Cash payment type. Amount to payment in kopecks no more than 14 characters
 * @property int $Electronic     Type of payment "Cashless"
 * @property int $AdvancePayment Type of payment "Preliminary payment (advance)"
 * @property int $Credit         Type of payment "Post-payment (credit)"
 * @property int $Provision      Type of payment "Other payment form"
 */
class Payments extends AbstractData
{
}

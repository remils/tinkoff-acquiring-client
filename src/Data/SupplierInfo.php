<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Payment Agent Supplier Data
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/init-request/#SupplierInfo
 *
 * @property string[] $Phones Phone supplier
 * @property string   $Name   Supplier name
 * @property string   $Inn    INN supplier
 */
class SupplierInfo extends AbstractData
{
}

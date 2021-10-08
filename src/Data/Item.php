<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Array containing product information
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/init-request/#Items
 *
 * @property string       $Name          Name of product
 * @property float        $Quantity      Number or weight of the goods
 * @property int          $Amount        Cost of goods in kopecks
 * @property int          $Price         Price per unit of goods in kopecks
 * @property string       $PaymentMethod Sign of payment method
 * @property string       $PaymentObject Sign of the subject of the calculation
 * @property string       $Tax           VAT rate
 * @property string       $Ean13         Barcode in the required format
 * @property AgentData    $AgentData     Agent data
 * @property SupplierInfo $SupplierInfo  Payment Agent Supplier Data
 */
class Item extends AbstractData
{
}

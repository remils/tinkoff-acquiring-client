<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Creation of order
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/init-request/
 *
 * @property string  $TerminalKey     Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
 * @property int     $Amount          Amount in kopecks
 * @property string  $OrderId         Order ID in the seller
 * @property string  $IP              Buyer's IP address
 * @property string  $Description     Description of order
 * @property string  $Language        Payment form language
 * @property string  $Recurrent       Parental payment identifier
 * @property string  $CustomerKey     Buyer identifier in the seller's system. Transmitted with the Cardid parameter
 * @property string  $RedirectDueDate Lifestyle Lifts (no more than 90 days)
 * @property string  $NotificationURL Address for receiving HTTP notifications
 * @property string  $SuccessURL      Page success
 * @property string  $FailURL         Error page
 * @property string  $PayType         Payment type
 * @property Receipt $Receipt         An array of check data
 * @property array   $DATA            Advanced payment options in "Key" format: "Value" (no more than 20 pairs)
 */
class Init extends AbstractDataWithToken
{
}

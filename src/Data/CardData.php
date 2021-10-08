<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Card data
 *
 * @property int    $PAN        Card number
 * @property string $ExpDate    Month and year of the duration of the card. In MMYY format
 * @property string $CardHolder Name and surname card holder as on map
 * @property string $CVV        Protection code
 * @property string $ECI        Electronic Commerce Indicator. The indicator showing the degree of protection used in
 *                              providing the buyer of its TSP data. Used and is required for Apple Pay or Google Pay
 * @property string $CAVV       Cardholder Authentication Verification Value or Accountholder Authentication Value
 *                              Used and is required for Apple Pay or Google Pay
 */
class CardData extends AbstractData
{
}

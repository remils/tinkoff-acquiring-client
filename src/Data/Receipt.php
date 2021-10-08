<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Data object check
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/init-request/#Receipt
 *
 * @property string   $Email        Email buyer
 * @property string   $Phone        Phone buyer
 * @property string   $EmailCompany Email seller
 * @property string   $Taxation     Taxation system
 * @property Item[]   $Items        Array of check positions with information about goods
 * @property Payments $Payments     Object with payment sum of the amount of payment
 */
class Receipt extends AbstractData
{
    /**
     * Generation of an empty array of check positions
     *
     * @param int $count Number of generated positions
     */
    public function initItems(int $count): void
    {
        unset($this->Items);

        $items = [];

        for ($i = 0; $i < $count; $i++) {
            $items[] = new Item();
        }

        $this->Items = $items;

        unset($items);
    }

    /**
     * Conclusion of positions from the array
     *
     * @param int $index Position
     */
    public function getItem(int $index): Item
    {
        return $this->Items[$index];
    }
}

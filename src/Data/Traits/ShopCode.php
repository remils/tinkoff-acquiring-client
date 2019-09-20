<?php

declare(strict_types=1);

/**
 * Код магазина
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait ShopCode
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait ShopCode
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $shopCode
     *
     * @return $this
     */
    public function setShopCode($shopCode)
    {
        $this->data['ShopCode'] = $shopCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShopCode()
    {
        return $this->data['ShopCode'];
    }

    /**
     * @return $this
     */
    public function removeShopCode()
    {
        unset($this->data['ShopCode']);

        return $this;
    }
}
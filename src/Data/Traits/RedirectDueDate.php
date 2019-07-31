<?php

/**
 * Cрок жизни ссылки. Eсли текущая дата превышает дату переданную в данном параметре, ссылка
 * для оплаты становится недоступной и платёж выполнить нельзя.
 * Формат даты: YYYY-MM-DDTHH24:MI:SS+GMT
 * Пример даты: 2016-08-31T12:28:00+03:00
 * Максимальный срок жизни ссылки – 90 дней
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait RedirectDueDate
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait RedirectDueDate
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $redirectDueDate
     *
     * @return $this
     */
    public function setRedirectDueDate($redirectDueDate)
    {
        $this->data['RedirectDueDate'] = $redirectDueDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRedirectDueDate()
    {
        return $this->data['RedirectDueDate'];
    }

    /**
     * @return $this
     */
    public function removeRedirectDueDate()
    {
        unset($this->data['RedirectDueDate']);

        return $this;
    }
}
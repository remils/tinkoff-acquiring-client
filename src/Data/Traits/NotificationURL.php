<?php

/**
 * URL на веб-сайте продавца, куда будет отправлен POST запрос о статусе выполнения вызываемых
 * методов (настраивается в Личном кабинете).
 * Если параметр передан – используется его значение.
 * Если нет – значение в настройках терминала.
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait NotificationURL
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait NotificationURL
{
    /**
     * @var array 
     */
    private $data = [];

    /**
     * @param $notificationURL
     *
     * @return $this
     */
    public function setNotificationURL($notificationURL)
    {
        $this->data['NotificationURL'] = $notificationURL;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotificationURL()
    {
        return $this->data['NotificationURL'];
    }

    /**
     * @return $this
     */
    public function removeNotificationURL()
    {
        unset($this->data['NotificationURL']);

        return $this;
    }
}
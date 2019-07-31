<?php

/**
 * Признак предмета расчёта.Если значение не передано, по умолчанию в онлайн-кассу отправляется признак
 * предмета расчёта "commodity".
 * Возможные значения:
 * commodity – товар.
 * excise – подакцизный товар.
 * job – работа.
 * service – услуга.
 * gambling_bet – ставка азартной игры.
 * gambling_prize – выигрыш азартной игры.
 * lottery – лотерейный билет.
 * lottery_prize – выигрыш лотереи.
 * intellectual_activity – предоставление результатов интеллектуальной деятельности.
 * payment – платеж.
 * agent_commission – агентское вознаграждение.
 * composite – составной предмет расчета.
 * another – иной предмет расчета.
 */

namespace SergeyZatulivetrov\TinkoffAcquiring\Data\Traits;

/**
 * Trait PaymentObject
 * @package SergeyZatulivetrov\TinkoffAcquiring\Data\Traits
 */
trait PaymentObject
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $paymentObject
     *
     * @return $this
     */
    public function setPaymentObject($paymentObject)
    {
        $this->data['PaymentObject'] = $paymentObject;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentObject()
    {
        return $this->data['PaymentObject'];
    }

    /**
     * @return $this
     */
    public function removePaymentObject()
    {
        unset($this->data['PaymentObject']);

        return $this;
    }
}
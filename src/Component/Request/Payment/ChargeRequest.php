<?php

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * ChargeRequest
 *
 * @phpstan-type T array{
 *      PaymentId: string,
 *      RebillId: string,
 *      IP: string,
 *      SendEmail: bool,
 *      InfoEmail: string,
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class ChargeRequest implements ComponentInterface
{
    /**
     * @param string  $paymentId Уникальный идентификатор транзакции в системе Т‑Бизнес
     * @param string  $rebillId  Идентификатор рекуррентного платежа
     * @param ?string $ip        IP-адрес клиента
     * @param ?bool   $sendEmail true — если клиент хочет получать уведомления на почту
     * @param ?string $infoEmail Адрес почты клиента. Обязателен при передаче SendEmail
     */
    public function __construct(
        public readonly string $paymentId,
        public readonly string $rebillId,
        public readonly ?string $ip = null,
        public readonly ?bool $sendEmail = null,
        public readonly ?string $infoEmail = null,
    ) {
    }

    public static function factory(array $data): ComponentInterface
    {
        return new ChargeRequest(
            paymentId: $data['PaymentId'],
            rebillId:  $data['RebillId'],
            ip:        $data['IP'] ?? null,
            sendEmail: $data['SendEmail'] ?? null,
            infoEmail: $data['InfoEmail'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['PaymentId'] = $this->paymentId;
        $data['RebillId'] = $this->rebillId;

        if ($this->ip !== null) {
            $data['IP'] = $this->ip;
        }

        if ($this->sendEmail !== null) {
            $data['SendEmail'] = $this->sendEmail;
        }

        if ($this->infoEmail !== null) {
            $data['InfoEmail'] = $this->infoEmail;
        }

        return $data;
    }
}

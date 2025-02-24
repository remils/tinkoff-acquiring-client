<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\Init;

use DateTimeImmutable;
use DateTimeInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Collection\ShopCollection;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt\Receipt;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Shop;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\LanguageEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\PayTypeEnum;

/**
 * InitPaymentRequest
 *
 * Инициализация оплаты
 *
 * @phpstan-import-type T from Shop as TShop
 * @phpstan-import-type T from Receipt as TReceipt
 * @phpstan-type TData array<string,string>
 * @phpstan-type T array{
 *      OrderId:         string,
 *      Amount:          int,
 *      DATA:            ?TData,
 *      Description:     ?string,
 *      CustomerKey:     ?string,
 *      Recurrent:       ?string,
 *      PayType:         ?string,
 *      Language:        ?string,
 *      NotificationURL: ?string,
 *      SuccessURL:      ?string,
 *      FailURL:         ?string,
 *      RedirectDueDate: ?string,
 *      Receipt:         ?TReceipt,
 *      Shops:           ?TShop[],
 *      Descriptor:      ?string
 * }
 *
 * @implements InitRequestInterface<T>
 */
class InitPaymentRequest implements InitRequestInterface
{
    /**
     * @param string             $orderId         Уникальный номер заказа в системе Продавца
     * @param int                $amount          Сумма в копейках
     * @param ?TData             $data            Дополнительные параметры
     * @phpcs:ignore
     * @param ?string            $description     Описание заказа. Значение параметра будет отображено на платежной форме
     * @phpcs:ignore
     * @param ?string            $customerKey     Идентификатор клиента в системе Продавца. Обязателен, если передан атрибут Recurrent.
     * @phpcs:ignore
     * @param ?string            $recurrent       Признак родительского рекуррентного платежа. Обязателен для регистрации автоплатежа.
     * @phpcs:ignore
     * @param ?PayTypeEnum       $payType         Определяет тип проведения платежа — двухстадийная или одностадийная оплата
     * @phpcs:ignore
     * @param ?LanguageEnum      $language        Язык платежной формы
     * @phpcs:ignore
     * @param ?string            $notificationUrl URL на веб-сайте Продавца, куда будет отправлен POST-запрос о статусе выполнения вызываемых методов
     * @phpcs:ignore
     * @param ?string            $successUrl      URL на веб-сайте Продавца, куда будет переведен клиент в случае успешной оплаты
     * @phpcs:ignore
     * @param ?string            $failUrl         URL на веб-сайте Продавца, куда будет переведен клиент в случае неуспешной оплаты
     * @phpcs:ignore
     * @param ?DateTimeInterface $redirectDueDate Срок жизни ссылки или динамического QR-кода СБП, если выбран этот способ оплаты.
     * @param ?Receipt           $receipt         Объект с данными чека
     * @param ?ShopCollection    $shops           Коллекция объектов с данными маркетплейса
     * @param ?string            $descriptor      Динамический дескриптор точки.
     *
     */
    public function __construct(
        public readonly string $orderId,
        public readonly int $amount,
        public readonly ?array $data = null,
        public readonly ?string $description = null,
        public readonly ?string $customerKey = null,
        public readonly ?string $recurrent = null,
        public readonly ?PayTypeEnum $payType = null,
        public readonly ?LanguageEnum $language = null,
        public readonly ?string $notificationUrl = null,
        public readonly ?string $successUrl = null,
        public readonly ?string $failUrl = null,
        public readonly ?DateTimeInterface $redirectDueDate = null,
        public readonly ?Receipt $receipt = null,
        public readonly ?ShopCollection $shops = null,
        public readonly ?string $descriptor = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new InitPaymentRequest(
            orderId:         $data['OrderId'],
            amount:          $data['Amount'],
            data:            $data['DATA'] ?? null,
            description:     $data['Description'] ?? null,
            customerKey:     $data['CustomerKey'] ?? null,
            recurrent:       $data['Recurrent'] ?? null,
            payType:         empty($data['PayType']) ? null : PayTypeEnum::from($data['PayType']),
            language:        empty($data['Language']) ? null : LanguageEnum::from($data['Language']),
            notificationUrl: $data['NotificationURL'] ?? null,
            successUrl:      $data['SuccessURL'] ?? null,
            failUrl:         $data['FailURL'] ?? null,
            redirectDueDate: empty($data['RedirectDueDate']) ? null : new DateTimeImmutable($data['RedirectDueDate']),
            receipt:         empty($data['Receipt']) ? null : Receipt::factory($data['Receipt']),
            shops:           empty($data['Shops']) ? null : ShopCollection::factory($data['Shops']),
            descriptor:      $data['Descriptor'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['OrderId'] = $this->orderId;
        $data['Amount']  = $this->amount;

        if (null !== $this->data) {
            $data['DATA'] = $this->data;
        }

        if (null !== $this->description) {
            $data['Description'] = $this->description;
        }

        if (null !== $this->customerKey) {
            $data['CustomerKey'] = $this->customerKey;
        }

        if (null !== $this->recurrent) {
            $data['Recurrent'] = $this->recurrent;
        }

        if (null !== $this->payType) {
            $data['PayType'] = $this->payType->value;
        }

        if (null !== $this->language) {
            $data['Language'] = $this->language->value;
        }

        if (null !== $this->notificationUrl) {
            $data['NotificationURL'] = $this->notificationUrl;
        }

        if (null !== $this->successUrl) {
            $data['SuccessURL'] = $this->successUrl;
        }

        if (null !== $this->failUrl) {
            $data['FailURL'] = $this->failUrl;
        }

        if (null !== $this->redirectDueDate) {
            $data['RedirectDueDate'] = $this->redirectDueDate->format(DateTimeInterface::RFC3339);
        }

        if (null !== $this->receipt) {
            $data['Receipt'] = $this->receipt->toArray();
        }

        if (null !== $this->shops) {
            $data['Shops'] = $this->shops->toArray();
        }

        if (null !== $this->descriptor) {
            $data['Descriptor'] = $this->descriptor;
        }

        return $data;
    }
}

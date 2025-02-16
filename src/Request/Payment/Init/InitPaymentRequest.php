<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\Init;

use DateTime;
use SergeyZatulivetrov\TinkoffAcquiring\Collection\ShopCollection;
use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\Receipt;
use SergeyZatulivetrov\TinkoffAcquiring\Entity\Shop;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\LanguageEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\PayTypeEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * InitPaymentRequest
 *
 * Инициализация оплаты
 *
 * @template TSignatureData of array<string,string>
 *
 * @phpstan-import-type TData from Shop as TShop
 * @phpstan-import-type TData from Receipt as TReceipt
 *
 * @phpstan-type TData array{
 *      TerminalKey: string,
 *      OrderId: string,
 *      Amount: integer,
 *      DATA: array<string,string|integer|float|boolean>,
 *      Description: string,
 *      CustomerKey: string,
 *      Recurrent: string,
 *      PayType: string,
 *      Language: string,
 *      NotificationURL: string,
 *      SuccessURL: string,
 *      FailURL: string,
 *      RedirectDueDate: string,
 *      Receipt: TReceipt,
 *      Shops: TShop[],
 *      Descriptor: string
 * }
 *
 * @implements InitRequestInterface<TData,TSignatureData>
 */
class InitPaymentRequest implements InitRequestInterface
{
    /**
     * @param string $orderId Уникальный номер заказа в системе Мерчанта
     * @param int $amount Сумма в копейках
     * @param array<string,string|integer|float|boolean>|null $data Дополнительные параметры
     * @param ?string $description Описание заказа. Значение параметра будет отображено на платежной форме.
     * @param ?string $customerKey Идентификатор клиента в системе мерчанта. Обязателен, если передан атрибут Recurrent.
     * @param ?string $recurrent Признак родительского рекуррентного платежа. Обязателен для регистрации автоплатежа.
     * @param ?PayTypeEnum $payType Определяет тип проведения платежа — двухстадийная или одностадийная оплата
     * @param ?LanguageEnum $language Язык платежной формы. Если не передан, форма откроется на русском языке.
     * @param ?string $notificationUrl URL на веб-сайте мерчанта, куда будет отправлен POST-запрос о статусе выполнения
     *                                 вызываемых методов — настраивается в личном кабинете.
     * @param ?string $successUrl URL на веб-сайте мерчанта, куда будет переведен клиент в случае успешной
     *                            оплаты — настраивается в личном кабинете.
     * @param ?string $failUrl URL на веб-сайте мерчанта, куда будет переведен клиент в случае неуспешной
     *                         оплаты — настраивается в личном кабинете.
     * @param ?DateTime $redirectDueDate Срок жизни ссылки или динамического QR-кода СБП, если выбран этот способ
     *                                   оплаты.
     * @param ?Receipt $receipt Объект с данными чека. Обязателен, если подключена онлайн-касса.
     * @param ?ShopCollection $shops Коллекция объектов с данными маркетплейса. Обязателен для маркетплейсов.
     * @param ?string $descriptor Динамический дескриптор точки.
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
        public readonly ?DateTime $redirectDueDate = null,
        public readonly ?Receipt $receipt = null,
        public readonly ?ShopCollection $shops = null,
        public readonly ?string $descriptor = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function build(string $terminalKey, SignatureServiceInterface $signatureService)
    {
        /**
         * @var TData $data
         */
        $data = [];

        $data['TerminalKey'] = $terminalKey;
        $data['OrderId'] = $this->orderId;
        $data['Amount'] = $this->amount;

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
            $data['RedirectDueDate'] = $this->redirectDueDate->format('YYYY-MM-DDTHH24:MI:SS+GMT');
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

        return $signatureService->signedRequest($data);
    }
}

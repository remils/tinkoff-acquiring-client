<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentMethodEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentObjectEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\VatEnum;

/**
 * ReceiptItem
 *
 * @phpstan-import-type TData from AgentData as TAgentData
 * @phpstan-import-type TData from SupplierInfo as TSupplierInfo
 * @phpstan-import-type TData from MarkQuantity as TMarkQuantity
 * @phpstan-import-type TData from SectoralItemProps as TSectoralItemProps
 * @phpstan-import-type TData from MarkCode as TMarkCode
 *
 * @phpstan-type TData array{
 *      Name: string,
 *      Quantity: float,
 *      Amount: int,
 *      Price: int,
 *      Tax: string,
 *      PaymentMethod: string|null,
 *      PaymentObject: string|null,
 *      Ean13: string|null,
 *      AgentData: TAgentData|null,
 *      SupplierInfo: TSupplierInfo|null,
 *      MarkQuantity: TMarkQuantity|null,
 *      SectoralItemProps: TSectoralItemProps|null,
 *      CountryCode: string|null,
 *      DeclarationNumber: string|null,
 *      Excise: string|null,
 *      MarkCode: TMarkCode|null,
 *      MarkProcessingMode: string|null,
 *      MeasurementUnit: string|null,
 *      ShopCode: string|null,
 *      UserData: string|null
 * }
 */
class ReceiptItem
{
    /**
     * @param string $name Наименование товара.
     * @param int $price Цена в копейках
     * @param float $quantity Количество или вес товара.
     * Максимальное количество символов - 8, где целая часть не более 5 знаков, а дробная часть не более 3 знаков
     * для Атол, не более 2 знаков для CloudPayments.
     * Значение «1», если передан объект MarkCode
     * @param int $amount Стоимость товара в копейках. Произведение Quantity и Price
     * @param VatEnum $tax Ставка НДС.
     * @param PaymentMethodEnum|null $paymentMethod Признак способа расчёта.
     * @param PaymentObjectEnum|null $paymentObject Признак предмета расчета.
     * @param string|null $userData Дополнительный реквизит предмета расчета.
     * @param string|null $excise Сумма акциза в рублях с учетом копеек, включенная в стоимость предмета расчета.
     * - Целая часть не более 8 знаков;
     * - дробная часть не более 2 знаков;
     * - значение не может быть отрицательным.
     * @param string|null $countryCode Цифровой код страны происхождения товара в соответствии с Общероссийским
     * классификатором стран мира (3 цифры)
     * @param string|null $declarationNumber Номер таможенной декларации
     * @param string|null $measurementUnit Единицы измерения. Передавать в соответствии с ОК 015-94 (МК 002-97)).
     * Возможные варианты указаны в статье (также возможна передача произвольных значений).
     * MeasurementUnit обязателен, в случае если ФФД онлайн-кассы 1.2.
     * @param string|null $markProcessingMode Режим обработки кода маркировки. Должен принимать значение равное «0».
     * Включается в чек в случае, если предметом расчета является товар, подлежащий обязательной маркировке средством
     * идентификации (соответствующий код в поле paymentObject).
     * @param MarkCode|null $markCode Код маркировки в машиночитаемой форме, представленный в виде одного из видов
     * кодов, формируемых в соответствии с требованиями, предусмотренными правилами, для нанесения на потребительскую
     * упаковку, или на товары, или на товарный ярлык
     * - Включается в чек в случае, если предметом расчета является товар, подлежащий обязательной маркировке средством
     * идентификации (соответствующий код в поле paymentObject)
     * @param MarkQuantity|null $markQuantity Реквизит «дробное количество маркированного товара». Передается только
     * в случае, если расчет осуществляется за маркированный товар (соответствующий код в поле paymentObject) и значение
     * в поле measurementUnit равно «0».
     * MarkQuantity не является обязательным объектом, в том числе для товаров с маркировкой. Этот объект
     * МОЖНО передавать, если товар с маркировкой. Т.е. даже при ФФД 1.2 этот объект не является обязательным.
     * @param SectoralItemProps|null $sectoralItemProps Отраслевой реквизит предмета расчета. Необходимо указывать
     * только для товаров подлежащих обязательной маркировке средством идентификации и включение данного реквизита
     * предусмотрено НПА отраслевого регулирования для соответствующей товарной группы.
     * @param string|null $ean13 Штрих-код в требуемом формате. В зависимости от типа кассы требования могут отличаться:
     * - АТОЛ Онлайн - шестнадцатеричное представление с пробелами. Максимальная длина –
     * 32 байта (^[a-fA-F0-9]{2}$)|(^([afA-F0-9]{2}\s){1,31}[a-fA-F0-9]{2}$)
     * Пример: 00 00 00 01 00 21 FA 41 00 23 05 41 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 12 00 AB 00
     * - CloudKassir - длина строки: четная, от 8 до 150 байт, т.е. от 16 до 300 ASCII символов ['0' - '9' , 'A' - 'F' ]
     * шестнадцатеричного представления кода маркировки товара. Пример: 303130323930303030630333435
     * - OrangeData - строка, содержащая base64 кодированный массив от 8 до 32 байт
     * Пример: igQVAAADMTIzNDU2Nzg5MDEyMwAAAAAAAQ==
     * В случае передачи в запросе параметра Ean13 не прошедшего валидацию, возвращается неуспешный ответ с текстом
     * ошибки в параметре message = "Неверный параметр Ean13".
     * @param string|null $shopCode Код магазина. Для параметра ShopСode необходимо использовать значение параметра
     * Submerchant_ID, полученного в ответ при регистрации магазинов через xml. Если xml не используется, передавать
     * поле не нужно.
     * @param AgentData|null $agentData Данные агента. Обязателен, если используется агентская схема.
     * @param SupplierInfo|null $supplierInfo Данные поставщика платежного агента.
     * Обязателен, если передается значение AgentSign в объекте AgentData.
     */
    public function __construct(
        public readonly string $name,
        public readonly float $quantity,
        public readonly int $amount,
        public readonly int $price,
        public readonly VatEnum $tax,
        public readonly ?PaymentMethodEnum $paymentMethod = null,
        public readonly ?PaymentObjectEnum $paymentObject = null,
        public readonly ?string $ean13 = null,
        public readonly ?AgentData $agentData = null,
        public readonly ?SupplierInfo $supplierInfo = null,
        public readonly ?MarkQuantity $markQuantity = null,
        public readonly ?SectoralItemProps $sectoralItemProps = null,
        public readonly ?string $countryCode = null,
        public readonly ?string $declarationNumber = null,
        public readonly ?string $excise = null,
        public readonly ?MarkCode $markCode = null,
        public readonly ?string $markProcessingMode = null,
        public readonly ?string $measurementUnit = null,
        public readonly ?string $shopCode = null,
        public readonly ?string $userData = null,
    ) {
    }

    /**
     * @return TData
     */
    public function toArray(): array
    {
        /**
         * @var TData $data
         */
        $data = [
            'Name' => $this->name,
            'Quantity' => $this->quantity,
            'Amount' => $this->amount,
            'Price' => $this->price,
            'Tax' => $this->tax->value,
        ];

        if (null !== $this->paymentMethod) {
            $data['PaymentMethod'] = $this->paymentMethod->value;
        }

        if (null !== $this->paymentObject) {
            $data['PaymentObject'] = $this->paymentObject->value;
        }

        if (null !== $this->ean13) {
            $data['Ean13'] = $this->ean13;
        }

        if (null !== $this->declarationNumber) {
            $data['DeclarationNumber'] = $this->declarationNumber;
        }

        if (null !== $this->userData) {
            $data['UserData'] = $this->userData;
        }

        if (null !== $this->shopCode) {
            $data['ShopCode'] = $this->shopCode;
        }

        if (null !== $this->agentData) {
            $data['AgentData'] = $this->agentData->toArray();
        }

        if (null !== $this->supplierInfo) {
            $data['SupplierInfo'] = $this->supplierInfo->toArray();
        }

        if (null !== $this->markQuantity) {
            $data['MarkQuantity'] = $this->markQuantity->toArray();
        }

        if (null !== $this->sectoralItemProps) {
            $data['SectoralItemProps'] = $this->sectoralItemProps->toArray();
        }

        if (null !== $this->countryCode) {
            $data['CountryCode'] = $this->countryCode;
        }

        if (null !== $this->excise) {
            $data['Excise'] = $this->excise;
        }

        if (null !== $this->markCode) {
            $data['MarkCode'] = $this->markCode->toArray();
        }

        if (null !== $this->markProcessingMode) {
            $data['MarkProcessingMode'] = $this->markProcessingMode;
        }

        if (null !== $this->measurementUnit) {
            $data['MeasurementUnit'] = $this->measurementUnit;
        }

        return $data;
    }
}

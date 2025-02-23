<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentMethodEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\PaymentObjectEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\VatEnum;

/**
 * ReceiptItem
 *
 * @phpstan-import-type T from AgentData as TAgentData
 * @phpstan-import-type T from SupplierInfo as TSupplierInfo
 * @phpstan-import-type T from MarkQuantity as TMarkQuantity
 * @phpstan-import-type T from SectoralItemProps as TSectoralItemProps
 * @phpstan-import-type T from MarkCode as TMarkCode
 *
 * @phpstan-type T array{
 *      Name:               string,
 *      Quantity:           float,
 *      Amount:             int,
 *      Price:              int,
 *      Tax:                string,
 *      PaymentMethod:      ?string,
 *      PaymentObject:      ?string,
 *      Ean13:              ?string,
 *      AgentData:          ?TAgentData,
 *      SupplierInfo:       ?TSupplierInfo,
 *      MarkQuantity:       ?TMarkQuantity,
 *      SectoralItemProps:  ?TSectoralItemProps,
 *      CountryCode:        ?string,
 *      DeclarationNumber:  ?string,
 *      Excise:             ?string,
 *      MarkCode:           ?TMarkCode,
 *      MarkProcessingMode: ?string,
 *      MeasurementUnit:    ?string,
 *      ShopCode:           ?string,
 *      UserData:           ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class ReceiptItem implements ComponentInterface
{
    /**
     * @param string             $name               Наименование товара
     * @param int                $price              Цена в копейках
     * @param float              $quantity           Количество или вес товара
     * @param int                $amount             Стоимость товара в копейках. Произведение Quantity и Price
     * @param VatEnum            $tax                Ставка НДС
     * @param ?PaymentMethodEnum $paymentMethod      Признак способа расчёта
     * @param ?PaymentObjectEnum $paymentObject      Признак предмета расчета
     * @param ?string            $userData           Дополнительный реквизит предмета расчета
     * @param ?string            $excise             Сумма акциза в рублях с учетом копеек
     * @param ?string            $countryCode        Цифровой код страны происхождения товара
     * @param ?string            $declarationNumber  Номер таможенной декларации
     * @param ?string            $measurementUnit    Единицы измерения
     * @param ?string            $markProcessingMode Режим обработки кода маркировки
     * @param ?MarkCode          $markCode           Код маркировки в машиночитаемой форме
     * @param ?MarkQuantity      $markQuantity       Реквизит «дробное количество маркированного товара»
     * @param ?SectoralItemProps $sectoralItemProps  Отраслевой реквизит предмета расчета
     * @param ?string            $ean13              Штрих-код в требуемом формате
     * @param ?string            $shopCode           Код магазина
     * @param ?AgentData         $agentData          Данные агента
     * @param ?SupplierInfo      $supplierInfo       Данные поставщика платежного агента
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

    public static function factory(array $data): self
    {
        return new ReceiptItem(
            name:               $data['Name'],
            quantity:           $data['Quantity'],
            amount:             $data['Amount'],
            price:              $data['Price'],
            tax:                VatEnum::from($data['Tax']),
            paymentMethod:      empty($data['PaymentMethod']) ? null : PaymentMethodEnum::from($data['PaymentMethod']),
            paymentObject:      empty($data['PaymentObject']) ? null : PaymentObjectEnum::from($data['PaymentObject']),
            ean13:              $data['Ean13'] ?? null,
            agentData:          empty($data['AgentData']) ? null : AgentData::factory($data['AgentData']),
            supplierInfo:       empty($data['SupplierInfo']) ? null : SupplierInfo::factory($data['SupplierInfo']),
            markQuantity:       empty($data['MarkQuantity']) ? null : MarkQuantity::factory($data['MarkQuantity']),
            sectoralItemProps:  empty($data['SectoralItemProps']) ? null : SectoralItemProps::factory($data['SectoralItemProps']), // @phpcs:ignore
            countryCode:        $data['CountryCode'] ?? null,
            declarationNumber:  $data['DeclarationNumber'] ?? null,
            excise:             $data['Excise'] ?? null,
            markCode:           empty($data['MarkCode']) ? null : MarkCode::factory($data['MarkCode']),
            markProcessingMode: $data['MarkProcessingMode'] ?? null,
            measurementUnit:    $data['MeasurementUnit'] ?? null,
            shopCode:           $data['ShopCode'] ?? null,
            userData:           $data['UserData'] ?? null
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['Name']     = $this->name;
        $data['Quantity'] = $this->quantity;
        $data['Amount']   = $this->amount;
        $data['Price']    = $this->price;
        $data['Tax']      = $this->tax->value;

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

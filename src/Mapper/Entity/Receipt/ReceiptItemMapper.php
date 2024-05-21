<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\ReceiptItem;

/**
 * ReceiptItemMapper
 *
 * @phpstan-import-type TItem from AgentDataMapper as TAgentData
 * @phpstan-import-type TItem from SupplierInfoMapper as TSupplierInfo
 * @phpstan-import-type TItem from MarkQuantityMapper as TMarkQuantity
 * @phpstan-import-type TItem from SectoralItemPropsMapper as TSectoralItemProps
 * @phpstan-import-type TItem from MarkCodeMapper as TMarkCode
 *
 * @phpstan-type TItem array{
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
class ReceiptItemMapper
{
    public function __construct(
        protected readonly AgentDataMapper $agentDataMapper,
        protected readonly MarkCodeMapper $markCodeMapper,
        protected readonly MarkQuantityMapper $markQuantityMapper,
        protected readonly SectoralItemPropsMapper $sectoralItemPropsMapper,
        protected readonly SupplierInfoMapper $supplierInfoMapper,
    ) {
    }

    /**
     * @param ReceiptItem $entity
     * @return TItem
     */
    public function item(ReceiptItem $entity)
    {
        /**
         * @var TItem $data
         */
        $data = [
            'Name' => $entity->name,
            'Quantity' => $entity->quantity,
            'Amount' => $entity->amount,
            'Price' => $entity->price,
            'Tax' => $entity->tax->value,
        ];

        if (null !== $entity->paymentMethod) {
            $data['PaymentMethod'] = $entity->paymentMethod->value;
        }

        if (null !== $entity->paymentObject) {
            $data['PaymentObject'] = $entity->paymentObject->value;
        }

        if (null !== $entity->ean13) {
            $data['Ean13'] = $entity->ean13;
        }

        if (null !== $entity->declarationNumber) {
            $data['DeclarationNumber'] = $entity->declarationNumber;
        }

        if (null !== $entity->userData) {
            $data['UserData'] = $entity->userData;
        }

        if (null !== $entity->shopCode) {
            $data['ShopCode'] = $entity->shopCode;
        }

        if (null !== $entity->agentData) {
            $data['AgentData'] = $this->agentDataMapper->item($entity->agentData);
        }

        if (null !== $entity->supplierInfo) {
            $data['SupplierInfo'] = $this->supplierInfoMapper->item($entity->supplierInfo);
        }

        if (null !== $entity->markQuantity) {
            $data['MarkQuantity'] = $this->markQuantityMapper->item($entity->markQuantity);
        }

        if (null !== $entity->sectoralItemProps) {
            $data['SectoralItemProps'] = $this->sectoralItemPropsMapper->item($entity->sectoralItemProps);
        }

        if (null !== $entity->countryCode) {
            $data['CountryCode'] = $entity->countryCode;
        }

        if (null !== $entity->excise) {
            $data['Excise'] = $entity->excise;
        }

        if (null !== $entity->markCode) {
            $data['MarkCode'] = $this->markCodeMapper->item($entity->markCode);
        }

        if (null !== $entity->markProcessingMode) {
            $data['MarkProcessingMode'] = $entity->markProcessingMode;
        }

        if (null !== $entity->measurementUnit) {
            $data['MeasurementUnit'] = $entity->measurementUnit;
        }

        return $data;
    }

    /**
     * @param ReceiptItem[] $items
     * @return TItem[]
     */
    public function collect(array $items): array
    {
        return array_map($this->item(...), $items);
    }
}

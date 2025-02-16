<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

/**
 * SectoralItemProps
 *
 * @phpstan-type TData array{
 *      FederalId: string,
 *      Date: string,
 *      Number: string,
 *      Value: string
 * }
 */
class SectoralItemProps
{
    /**
     * @param string $federalId Идентификатор ФОИВ (федеральный орган исполнительной власти).
     * @param string $date Дата нормативного акта ФОИВ
     * @param string $number Номер нормативного акта ФОИВ
     * @param string $value Состав значений, определенных нормативным актом ФОИВ.
     */
    public function __construct(
        public readonly string $federalId,
        public readonly string $date,
        public readonly string $number,
        public readonly string $value,
    ) {
    }

    /**
     * @return TData
     */
    public function toArray(): array
    {
        return [
            'FederalId' => $this->federalId,
            'Date' => $this->date,
            'Number' => $this->number,
            'Value' => $this->value,
        ];
    }
}

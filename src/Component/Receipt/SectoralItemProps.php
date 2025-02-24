<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * SectoralItemProps
 *
 * @phpstan-type T array{
 *      FederalId: string,
 *      Date:      string,
 *      Number:    string,
 *      Value:     string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class SectoralItemProps implements ComponentInterface
{
    /**
     * @param string $federalId Идентификатор ФОИВ (федеральный орган исполнительной власти)
     * @param string $date      Дата нормативного акта ФОИВ
     * @param string $number    Номер нормативного акта ФОИВ
     * @param string $value     Состав значений, определенных нормативным актом ФОИВ
     */
    public function __construct(
        public readonly string $federalId,
        public readonly string $date,
        public readonly string $number,
        public readonly string $value,
    ) {
    }

    public static function factory(array $data): self
    {
        return new SectoralItemProps(
            federalId: $data['FederalId'],
            date:      $data['Date'],
            number:    $data['Number'],
            value:     $data['Value'],
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['FederalId'] = $this->federalId;
        $data['Date']      = $this->date;
        $data['Number']    = $this->number;
        $data['Value']     = $this->value;

        return $data;
    }
}

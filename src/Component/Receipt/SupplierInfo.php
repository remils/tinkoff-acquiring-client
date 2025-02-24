<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * SupplierInfo
 *
 * @phpstan-type T array{
 *      Phones: ?string[],
 *      Name:   ?string,
 *      Inn:    ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class SupplierInfo implements ComponentInterface
{
    /**
     * @param ?string[] $phones Телефон поставщика, в формате +{Ц}
     * @param ?string   $name   Наименование поставщика
     * @param ?string   $inn    ИНН поставщика, в формате ЦЦЦЦЦЦЦЦЦЦ
     */
    public function __construct(
        public readonly ?array $phones = null,
        public readonly ?string $name = null,
        public readonly ?string $inn = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new SupplierInfo(
            phones: $data['Phones'] ?? null,
            name:   $data['Name'] ?? null,
            inn:    $data['Inn'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        if (null !== $this->phones) {
            $data['Phones'] = $this->phones;
        }

        if (null !== $this->name) {
            $data['Name'] = $this->name;
        }

        if (null !== $this->inn) {
            $data['Inn'] = $this->inn;
        }

        return $data;
    }
}

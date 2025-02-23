<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * ClientInfo
 *
 * @phpstan-type T array{
 *      Address:      ?string,
 *      Birthdate:    ?string,
 *      Citizenship:  ?string,
 *      DocumentCode: ?string,
 *      DocumentData: ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class ClientInfo implements ComponentInterface
{
    /**
     * @param ?string $birthdate    Дата рождения клиента в формате ДД.ММ.ГГГГ
     * @param ?string $citizenship  Числовой код страны, гражданином которой является клиент
     * @param ?string $documentCode Числовой код вида документа, удостоверяющего личность
     * @param ?string $documentData Реквизиты документа, удостоверяющего личность
     * @param ?string $address      Адрес клиента, грузополучателя
     */
    public function __construct(
        public readonly ?string $birthdate,
        public readonly ?string $citizenship,
        public readonly ?string $documentCode,
        public readonly ?string $documentData,
        public readonly ?string $address,
    ) {
    }

    public static function factory(array $data): self
    {
        return new ClientInfo(
            birthdate:    $data['Birthdate'] ?? null,
            citizenship:  $data['Citizenship'] ?? null,
            documentCode: $data['DocumentCode'] ?? null,
            documentData: $data['DocumentData'] ?? null,
            address:      $data['Address'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T $data
         */
        $data = [];

        if (null !== $this->address) {
            $data['Address'] = $this->address;
        }

        if (null !== $this->birthdate) {
            $data['Birthdate'] = $this->birthdate;
        }

        if (null !== $this->citizenship) {
            $data['Citizenship'] = $this->citizenship;
        }

        if (null !== $this->documentCode) {
            $data['DocumentCode'] = $this->documentCode;
        }

        if (null !== $this->documentData) {
            $data['DocumentData'] = $this->documentData;
        }

        return $data;
    }
}

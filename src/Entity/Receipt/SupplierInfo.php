<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

/**
 * SupplierInfo
 */
class SupplierInfo
{
    /**
     * @param string[]|null $phones Телефон поставщика, в формате +{Ц}.
     * Атрибут обязателен, если передается значение AgentSign в объекте AgentData
     * @param string|null $name Наименование поставщика. Атрибут обязателен, если передается значение
     * AgentSign в объекте AgentData.
     * Внимание: в данные 239 символов включаются телефоны поставщика
     * - 4 символа на каждый телефон. Например, если передано два телефона поставщика длиной 12 и 14 символов,
     * то максимальная длина наименования поставщика будет 239 – (12 + 4) – (14 + 4) = 205 символов
     * @param string|null $inn ИНН поставщика, в формате ЦЦЦЦЦЦЦЦЦЦ.
     * Атрибут обязателен, если передается значение AgentSign в объекте AgentData.
     */
    public function __construct(
        public readonly ?array $phones = null,
        public readonly ?string $name = null,
        public readonly ?string $inn = null,
    ) {
    }
}

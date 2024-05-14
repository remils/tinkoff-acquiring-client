<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

/**
 * MarkCode
 */
class MarkCode
{
    /**
     * @param string $markCodeType Тип штрих кода. Возможные значения:
     * - UNKNOWN - код товара, формат которого не идентифицирован, как один из реквизитов
     * - EAN8 - код товара в формате EAN-8.
     * - EAN13 - код товара в формате EAN-13
     * - ITF14 - код товара в формате ITF-14
     * - GS10 - код товара в формате GS1, нанесенный на товар, не подлежащий маркировке
     * - GS1M - код товара в формате GS1, нанесенный на товар, подлежащий маркировке
     * - SHORT - код товара в формате короткого кода маркировки, нанесенный на товар,
     * - FUR - контрольно-идентификационный знак мехового изделия.
     * - EGAIS20 - код товара в формате ЕГАИС-2.0.
     * - EGAIS30 - код товара в формате ЕГАИС-3.0.
     * - RAWCODE - Код маркировки, как он был прочитан сканером.
     * @param string $value Код маркировки
     */
    public function __construct(
        public readonly string $markCodeType,
        public readonly string $value,
    ) {
    }
}

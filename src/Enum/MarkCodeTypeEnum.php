<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * MarkCodeTypeEnum
 */
enum MarkCodeTypeEnum: string
{
    /**
     * Код товара, формат которого не идентифицирован, как один из реквизитов.
     */
    case Unknown = 'UNKNOWN';

    /**
     * Код товара в формате EAN-8.
     */
    case Ean8 = 'EAN8';

    /**
     * Код товара в формате EAN-13.
     */
    case Ean13 = 'EAN13';

    /**
     * Код товара в формате ITF-14.
     */
    case Itf14 = 'ITF14';

    /**
     * Код товара в формате GS1, нанесенный на товар, не подлежащий маркировке.
     */
    case Gs10 = 'GS10';

    /**
     * Код товара в формате GS1, нанесенный на товар, подлежащий маркировке.
     */
    case Gs1m = 'GS1M';

    /**
     * Код товара в формате короткого кода маркировки, нанесенный на товар.
     */
    case Short = 'SHORT';

    /**
     * Контрольно-идентификационный знак мехового изделия.
     */
    case Fur = 'FUR';

    /**
     * Код товара в формате ЕГАИС-2.0.
     */
    case Egais20 = 'EGAIS20';

    /**
     * Код товара в формате ЕГАИС-3.0.
     */
    case Egais30 = 'EGAIS30';

    /**
     * Код маркировки, как он был прочитан сканером.
     */
    case Rawcode = 'RAWCODE';
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

/**
 * MarkQuantity
 *
 * @phpstan-type TData array{
 *      Numerator: int,
 *      Denominator: int
 * }
 */
class MarkQuantity
{
    /**
     * @param int $numerator Числитель дробной части предмета расчета.
     * Значение должно быть строго меньше значения реквизита «знаменатель»
     * @param int $denominator Знаменатель дробной части предмета расчета.
     * Значение равно количеству товара в партии (упаковке), имеющей общий код маркировки товара.
     */
    public function __construct(
        public readonly int $numerator,
        public readonly int $denominator,
    ) {
    }

    /**
     * @return TData
     */
    public function toArray(): array
    {
        return [
            'Numerator' => $this->numerator,
            'Denominator' => $this->denominator,
        ];
    }
}

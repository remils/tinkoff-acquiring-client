<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * MarkQuantity
 *
 * @phpstan-type T array{
 *      Numerator:   int,
 *      Denominator: int
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class MarkQuantity implements ComponentInterface
{
    /**
     * @param int $numerator   Числитель дробной части предмета расчета
     * @param int $denominator Знаменатель дробной части предмета расчета
     */
    public function __construct(
        public readonly int $numerator,
        public readonly int $denominator,
    ) {
    }

    public static function factory(array $data): self
    {
        return new MarkQuantity(
            numerator: $data['Numerator'],
            denominator: $data['Denominator'],
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        $data['Numerator'] = $this->numerator;
        $data['Denominator'] = $this->denominator;

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component;

/**
 * @phpstan-template T of array<mixed>
 */
interface ComponentInterface
{
    /**
     * @param T $data
     * @return ComponentInterface<T>
     */
    public static function factory(array $data): self;

    /**
     * @return T
     */
    public function toArray(): array;
}

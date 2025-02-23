<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Collection;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;

/**
 * AbstractCollection
 *
 * @phpstan-template TData of array<string,mixed>
 * @phpstan-template TComponent of ComponentInterface<TData>
 * @phpstan-implements ComponentInterface<TData[]>
 */
abstract class AbstractCollection implements ComponentInterface
{
    /**
     * @var TComponent[]
     */
    protected array $items = [];

    /**
     * @inheritDoc
     *
     * @return AbstractCollection<TData,TComponent>
     */
    abstract public static function factory(array $data = []): self;

    /**
     * @param TComponent $item
     * @return AbstractCollection<TData,TComponent>
     */
    public function add(ComponentInterface $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function toArray(): array
    {
        /**
         * @var TData[]
         */
        $items = [];

        foreach ($this->items as $item) {
            $items[] = $item->toArray();
        }

        return $items;
    }
}

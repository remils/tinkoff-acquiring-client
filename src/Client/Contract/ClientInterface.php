<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Client\Contract;

/**
 * ClientInterface
 */
interface ClientInterface
{
    /**
     * Метод должен выполнять POST запрос
     *
     * @template TData of array<string,mixed>
     *
     * @param string $action
     * @param TData $data
     * @return mixed
     */
    public function execute(string $action, array $data): mixed;
}

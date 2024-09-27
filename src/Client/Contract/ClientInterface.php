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
     * @param string $action
     * @param array<string,mixed> $data
     * @return mixed
     */
    public function execute(string $action, $data): mixed;
}

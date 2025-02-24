<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Client\Contract;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;

/**
 * ClientInterface
 */
interface ClientInterface
{
    /**
     * Метод должен выполнять POST запрос
     *
     * @param string $action
     * @param array<string,mixed> $data
     *
     * @throws HttpException|TinkoffException
     *
     * @return mixed
     */
    public function execute(string $action, array $data): mixed;
}

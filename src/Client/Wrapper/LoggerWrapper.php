<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Client\Wrapper;

use Psr\Log\LoggerInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;

/**
 * LoggerWrapper
 */
class LoggerWrapper implements ClientInterface
{
    public function __construct(
        protected readonly ClientInterface $client,
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function execute(string $action, array $data): mixed
    {
        $uniqid = uniqid('SergeyZatulivetrov.TinkoffAcquiring.');

        $this->logger->debug(sprintf('%s: request "%s"', $uniqid, $action), $data);

        $response = $this->client->execute($action, $data);

        $this->logger->debug(sprintf('%s: response "%s"', $uniqid, $action), $response);

        return $response;
    }
}

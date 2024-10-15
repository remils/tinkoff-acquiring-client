<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Client;

use DateInterval;
use Psr\Cache\CacheItemPoolInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;

/**
 * CacheWrapperClient
 *
 * Клиент обернутый кешированием.
 * Основная задача клиента: снизить количество одинаковых обращений к сервису.
 *
 * @see https://symfony.com/doc/current/components/cache.html
 */
class CacheWrapperClient implements ClientInterface
{
    /**
     * @param ClientInterface $client
     * @param CacheItemPoolInterface $cache
     * @param DateInterval $expiresAfter
     */
    public function __construct(
        protected readonly ClientInterface $client,
        protected readonly CacheItemPoolInterface $cache,
        protected readonly DateInterval $expiresAfter = new DateInterval('PT15S'),
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(string $action, array $data): mixed
    {
        $key = $this->getCacheKey($action, $data);

        $item = $this->cache->getItem($key);

        if ($item->isHit()) {
            return $item->get();
        }

        $data = $this->client->execute($action, $data);

        $item->expiresAfter($this->expiresAfter);
        $item->set($data);

        $this->cache->save($item);

        return $data;
    }

    /**
     * @template TData of array<string,mixed>
     *
     * @param string $action
     * @param TData $data
     * @return string
     */
    protected function getCacheKey(string $action, array $data): string
    {
        return hash(
            'sha256',
            $action . '|' . $this->implodeData($data),
        );
    }

    /**
     * @template TData of array<string,mixed>
     *
     * @param TData $data
     * @return string
     */
    protected function implodeData(array $data): string
    {
        ksort($data);

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->implodeData($value);
            }
        }

        return implode('|', $data);
    }
}

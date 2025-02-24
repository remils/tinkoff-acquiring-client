# Композиция оберток

Если требуется обернуть в кеш и также включить логирование:

```php
use SergeyZatulivetrov\TinkoffAcquiring\Client\SocketClient;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Wrapper\CacheWrapper;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Wrapper\LoggerWrapper;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * @var CacheItemPoolInterface $cache
 */
$cache = ...;

/**
 * @var LoggerInterface $logger
 */
$logger = ...;

$client = new SocketClient(
    host: 'securepay.tinkoff.ru',
    port: 443,
    apiUrl: 'v2',
    ssl: true,
    timeout: 30,
);

$cacheWrapper = new CacheWrapper(
    client: $client,
    cache: $cache,
    expiresAfter: new DateInterval('PT30M'),
);

$loggerWrapper = new LoggerWrapper(
    client: $cacheWrapper,
    logger: $logger,
);

$loggerWrapper->execute($action, $data);
```
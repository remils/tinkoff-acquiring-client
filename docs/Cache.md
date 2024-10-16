# Кеширование ответов клиента

Для кеширования реализована обертка над PSR-Cache.

[DateInterval](https://www.php.net/manual/ru/dateinterval.construct.php) используется для установки времени жизни кеша.

```php
use SergeyZatulivetrov\TinkoffAcquiring\Client\Client;
use SergeyZatulivetrov\TinkoffAcquiring\Client\CacheWrapperClient;
use Psr\Cache\CacheItemPoolInterface;

/**
 * @var CacheItemPoolInterface $cache
 */
$cache = ...;

$client = new Client(apiUrl: 'https://rest-api-test.tinkoff.ru/v2/');

$cacheWrapperClient = new CacheWrapperClient(
    client: $client,
    cache: $cache,
    expiresAfter: new DateInterval('PT30M'),
);
```
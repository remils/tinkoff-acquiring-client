# Логирование

Для логирования реализована обертка над PSR-Logger.

```php
use SergeyZatulivetrov\TinkoffAcquiring\Client\SocketClient;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Wrapper\LoggerWrapper;
use Psr\Log\LoggerInterface;

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

$loggerWrapper = new LoggerWrapper(
    client: $client,
    logger: $logger,
);

$loggerWrapper->execute($action, $data);
```
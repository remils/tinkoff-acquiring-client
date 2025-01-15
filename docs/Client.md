# Инициализация клиента

Интернет-эквайринг:

- Тестовый URL: https://rest-api-test.tinkoff.ru/v2/

- Боевой URL (по умолчанию): https://securepay.tinkoff.ru/v2/

Массовые выплаты (неизвестно есть ли тестовый URL):

- Боевой URL: https://securepay.tinkoff.ru/e2c/v2/

На тестовом URL требуется получить доступ, иначе будет 403 код ошибки.

Curl клиент (требуется установить curl):

```php
use SergeyZatulivetrov\TinkoffAcquiring\Client\CurlClient;

$client = new CurlClient(apiUrl: 'https://rest-api-test.tinkoff.ru/v2/');
```

Socket клиент:

```php
use SergeyZatulivetrov\TinkoffAcquiring\Client\SocketClient;

$client = new SocketClient(
    host: 'securepay.tinkoff.ru',
    port: 443,
    apiUrl: 'v2',
    ssl: true,
    timeout: 30,
);
```

Клиент не используется напрямую (хотя такая возможность есть).

После инициализации требуется передать экземпляр объекта в нужный сервис, например в сервис Управления картами пользователей.
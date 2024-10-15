# Инициализация клиента

Интернет-эквайринг:

- Тестовый URL: https://rest-api-test.tinkoff.ru/v2/

- Боевой URL (по умолчанию): https://securepay.tinkoff.ru/v2/

Массовые выплаты (неизвестно есть ли тестовый URL):

- Боевой URL: https://securepay.tinkoff.ru/e2c/v2/

На тестовом URL требуется получить доступ, иначе будет 403 код ошибки.

```php
use SergeyZatulivetrov\TinkoffAcquiring\Client\Client;

$client = new Client(apiUrl: 'https://rest-api-test.tinkoff.ru/v2/');
```

Клиент не используется напрямую (хотя такая возможность есть).

После инициализации требуется передать экземпляр объекта в нужный сервис, например в сервис Управления картами пользователей.
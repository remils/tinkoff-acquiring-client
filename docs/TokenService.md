# Подписание запросов с помощью токен ключа

Более подробно про токен можно узнать [тут](https://www.tbank.ru/kassa/dev/payments/#section/Token).

Для подписания данных требуется передать в конструктор пароль (Пароль можно найти в личном кабинете Мерчанта).


```php
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\TokenService;

$service = new TokenService(
    password: 'Password',
    excludedProperties: ['Items'], // Названия ключей массива которые не должны участвовать в генерации токена.
);

$data = [
    'TerminalKey' => 'TestBank',
    'Items' => [1,2,3,4,5],
];

$data = $service->signedRequest($data);

var_dump($data['Token']);
```
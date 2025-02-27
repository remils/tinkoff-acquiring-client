# Tinkoff acquiring client

Новое решение клиента, которое покрывает маршруты: Приема платежей, Массовые выплаты.

1. Достаточно легко расширяется (Проработаны все аспекты SOLID).

2. Имеет PHPStan описание типов.

3. Использует PSR стандарты (Logger, Cache).

4. Покрыт тестами.

## Требования

- PHP 8.1 и выше

- curl (не обязательно)

- mbstring

- json

- openssl

## Быстрый старт

Чтобы установить пакет в проект, требуется выполнить команду:

```ssh
composer require sergey-zatulivetrov/tinkoff-acquiring-client:^4.0
```

Знакомимся с сервисами:

[Инициализация клиента](./docs/Client.md)

[Кеширование ответов клиента](./docs/Cache.md)

[Логирование запросов и ответов клиента](./docs/Log.md)

[Композиция оберток над клиентом](./docs/ComposeWrapper.md)

[Подписание запросов с помощью токен ключа](./docs/TokenService.md)

[Подписание запросов с помощью цифрового сертификата](./docs/CertificateService.md)

[Сервис управления пользователями](./docs/Customer.md)

[Сервис управления картами пользователя](./docs/Card.md)

[Сервис работы с платежами и выплатами](./docs/Payment.md)

## Развитие

Нашел баг? Делай PullRequest!

Есть идеи? Делай PullRequest!

В любой непонятной ситуации делай PullRequest (для более быстрого рассмотрения пингани в телеграм [@sergey_zatulivetrov](https://t.me/sergey_zatulivetrov))!

## Лицензия

Распространяется в рамках [MIT](./LICENSE).

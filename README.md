# Tinkoff acquiring client

PHP client for Tinkoff REST API.

## 1 Requirements

- PHP 7.1 or above

## 2 Installation

```sh
composer require 'sergey-zatulivetrov/tinkoff-acquiring-client'
```

## 3 Uses

### 3.1 Сonnection definition

```php
use SergeyZatulivetrov\TinkoffAcquiring\Client;

$client = new Client();
```

#### 3.1.1 Init connection

```php
$client->init($data);
```

#### 3.1.2 Confirm connection

```php
$client->confirm($data);
```

#### 3.1.3 Cancel connection

```php
$client->cancel($data);
```

#### 3.1.4 GetState connection

```php
$client->getState($data);
```

#### 3.1.5 Resend connection

```php
$client->resend($data);
```

## 4 License

Copyright (c) Zatulivetrov Sergey. Distributed under the MIT.

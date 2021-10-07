# Tinkoff acquiring client

PHP client for Tinkoff REST API.

## 1 Requirements

- PHP 7.0 or above

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

### 3.2 Data

#### 3.2.1 Init data

##### 3.2.1.1 Property

```php
/**
 * Class InitData
 *
 * @property string  $TerminalKey
 * @property integer $Amount
 * @property string  $OrderId
 * @property string  $IP
 * @property string  $Description
 * @property string  $Language
 * @property string  $CustomerKey
 * @property string  $Recurrent
 * @property string  $RedirectDueDate
 * @property array   $DATA
 * @property string  $NotificationURL
 * @property string  $SuccessURL
 * @property string  $FailURL
 * @property string  $PayType
 * @property array   $Receipt
 */
 
/**
 * Class ReceiptData
 *
 * @property array  $Items
 * @property string $Email
 * @property string $Phone
 * @property string $EmailCompany
 * @property string $Taxation
 */
 
/**
 * Class ItemData
 *
 * @property string  $Name
 * @property integer $Price
 * @property float   $Quantity
 * @property integer $Amount
 * @property string  $PaymentMethod
 * @property string  $PaymentObject
 * @property string  $Tax
 * @property string  $Ean13
 * @property string  $ShopCode
 */
```

##### 3.2.1.2 Example

```php
use SergeyZatulivetrov\TinkoffAcquiring\Constants\PaymentMethod;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\PaymentObject;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\Taxation;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\Vat;
use SergeyZatulivetrov\TinkoffAcquiring\Data\InitData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ItemData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ReceiptData;

$data              = new InitData();
$data->TerminalKey = "TestB";
$data->Amount      = 140000;
$data->OrderId     = "21050";
$data->Description = "Подарочная карта на 1400.00 рублей";
$data->DATA        = [
    "Phone" => "+71234567890",
    "Email" => "a@test.com",
];

$item1                = new ItemData();
$item1->Name          = "Наименование товара 1";
$item1->Price         = 10000;
$item1->Quantity      = 1.00;
$item1->Amount        = 10000;
$item1->PaymentMethod = PaymentMethod::FULL_PREPAYMENT;
$item1->PaymentObject = PaymentObject::COMMODITY;
$item1->Tax           = Vat::VAT10;
$item1->Ean13         = "0123456789";

$item2                = new ItemData();
$item2->Name          = "Наименование товара 2";
$item2->Price         = 20000;
$item2->Quantity      = 2.00;
$item2->Amount        = 40000;
$item2->PaymentMethod = PaymentMethod::PREPAYMENT;
$item2->PaymentObject = PaymentObject::SERVICE;
$item2->Tax           = Vat::VAT20;

$item3           = new ItemData();
$item3->Name     = "Наименование товара 3";
$item3->Price    = 30000;
$item3->Quantity = 3.00;
$item3->Amount   = 90000;
$item3->Tax      = Vat::VAT10;

$receipt               = new ReceiptData();
$receipt->Email        = "a@test.ru";
$receipt->Phone        = "+79031234567";
$receipt->EmailCompany = "b@test.ru";
$receipt->Taxation     = Taxation::OSN;
$receipt->Items        = [$item1, $item2, $item3];
$data->Receipt         = $receipt;
```

#### 3.2.2 Confirm data

##### 3.2.2.1 Property

```php
/**
 * Class ConfirmData
 *
 * @property string  $Token
 * @property string  $TerminalKey
 * @property integer $PaymentId
 * @property string  $IP
 * @property integer $Amount
 * @property array   $Receipt
 */
```

##### 3.2.2.2 Example

```php
use SergeyZatulivetrov\TinkoffAcquiring\Data\ConfirmData;

$data = new ConfirmData();
$data->TerminalKey = "TinkoffBankTest";
$data->PaymentId   = "2164657";
$data->generateToken("password");
```

#### 3.2.3 Cancel data

##### 3.2.3.1 Property

```php
/**
 * Class CancelData
 *
 * @property string  $Token
 * @property string  $TerminalKey
 * @property integer $PaymentId
 * @property string  $IP
 * @property integer $Amount
 * @property array   $Receipt
 */
```

##### 3.2.3.2 Example

```php
use SergeyZatulivetrov\TinkoffAcquiring\Data\CancelData;

$data = new CancelData();
$data->TerminalKey = "TinkoffBankTest";
$data->PaymentId   = "2164657";
$data->generateToken("password");
```

#### 3.2.4 GetState data

##### 3.2.4.1 Property

```php
/**
 * Class GetStateData
 *
 * @property string  $Token
 * @property string  $TerminalKey
 * @property integer $PaymentId
 * @property integer $Amount
 * @property string  $IP
 */
```

##### 3.2.4.2 Example

```php
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetStateData;

$data = new GetStateData();
$data->TerminalKey = "TinkoffBankTest";
$data->PaymentId   = "2164657";
$data->generateToken("password");
```

#### 3.2.5 Resend data

##### 3.2.5.1 Property

```php
/**
 * Class ResendData
 *
 * @property string $Token
 * @property string $TerminalKey
 */
```

##### 3.2.5.2 Example

```php
use SergeyZatulivetrov\TinkoffAcquiring\Data\ResendData;

$data = new ResendData();
$data->TerminalKey = "TinkoffBankTest";
$data->generateToken("password");
```

## 4 License

Copyright (c) Zatulivetrov Sergey. Distributed under the MIT.

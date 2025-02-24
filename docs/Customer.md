# Управление пользователями

```php
use SergeyZatulivetrov\TinkoffAcquiring\Service\CustomerService;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\AddCustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\CustomerRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Customer\RemoveCustomerRequest;



$service = new CardService(
    signatureService: $signatureService,
    client: $client,
);



// добавление пользователя
$request = AddCustomerRequest::factory([
    'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
    'Email' => 'username@test.ru',
    'Phone' => '+79031234567',
    'IP' => '10.100.10.10',
]);
// или
$request = new AddCustomerRequest(
    customerKey: '4387c647-a693-449d-bc35-91faecfc50de',
    email: 'username@test.ru',
    phone: '+79031234567',
    ip: '10.100.10.10',
);
$response = $service->addCustomer($request);



// просмотр информации о пользователе
$request = CustomerRequest::factory([
    'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
    'IP' => '10.100.10.10',
]);
// или
$request = new CustomerRequest(
    customerKey: '4387c647-a693-449d-bc35-91faecfc50de',
    ip: '10.100.10.10',
);
$response = $service->customer($request);



// удаление пользователя
$request = RemoveCustomerRequest::factory([
    'CustomerKey' => '4387c647-a693-449d-bc35-91faecfc50de',
    'IP' => '10.100.10.10',
]);
// или
$request = new RemoveCustomerRequest(
    customerKey: '4387c647-a693-449d-bc35-91faecfc50de',
    ip: '10.100.10.10',
);
$response = $service->removeCustomer($request);
```

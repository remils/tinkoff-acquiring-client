# Управление картами пользователя

```php
use SergeyZatulivetrov\TinkoffAcquiring\Service\CardService;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\AddCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\CardListRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Card\RemoveCardRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CheckTypeEnum;



$service = new CardService(
    signatureService: $signatureService,
    client: $client,
);



// добавление карты пользователю
$request = AddCardRequest::factory([
    'CustomerKey' => 'testCustomer1234',
    'CheckType' => 'NO',
    'ResidentState' => true,
    'IP' => '10.100.10.10',
]);
// или
$request = new AddCardRequest(
    customerKey: 'testCustomer1234',
    checkType: CheckTypeEnum::No,
    residentState: => true,
    ip: '10.100.10.10',
);
$response = $service->addCard($request);



// просмотр списка карт пользователя
$request = CardListRequest::factory([
    'CustomerKey' => 'testCustomer1234',
    'SavedCard' => true,
    'IP' => '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
]);
// или
$request = new CardListRequest(
    customerKey: 'testCustomer1234',
    savedCard: true,
    ip: '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
);
$response = $service->cardList($request);



// удаление карты пользователя
$request = RemoveCardRequest::factory([
    'CustomerKey' => 'testCustomer1234',
    'CardId' => '156516516',
    'IP' => '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
]);
// или
$request = new RemoveCardRequest(
    customerKey: 'testCustomer1234',
    cardId: '156516516',
    ip: '2011:0db8:85a3:0101:0101:8a2e:0370:7334',
);
$response = $service->removeCard($request);
```

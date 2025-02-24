# Сервис платежей

```php
use SergeyZatulivetrov\TinkoffAcquiring\Service\PaymentService;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\Init\InitPaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\Init\InitPayoutRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\PaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Request\Payment\StateRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Collection\ReceiptItemCollection;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt\Receipt;
use SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt\ReceiptItem;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\TaxationEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\VatEnum;



$paymentService = new PaymentService(
    signatureService: $signatureService,
    client: $client,
);



// инициализация платежа
$request = InitPaymentRequest::factory([
    'Amount' => 140000,
    'OrderId' => '21090',
    'Description' => 'Подарочная карта на 1000 рублей',
    'DATA' => [
        'Phone' => '+71234567890',
        'Email' => 'a@test.com',
    ],
    'Receipt' => [
        'Email' => 'a@test.ru',
        'Phone' => '+79031234567',
        'Taxation' => 'osn',
        'Items' => [
            [
                'Name' => 'Наименование товара 1',
                'Price' => 10000,
                'Quantity' => 1,
                'Amount' => 10000,
                'Tax' => 'vat10',
                'Ean13' => '303130323930303030630333435',
            ],
            [
                'Name' => 'Наименование товара 2',
                'Price' => 20000,
                'Quantity' => 2,
                'Amount' => 40000,
                'Tax' => 'vat20',
            ],
            [
                'Name' => 'Наименование товара 3',
                'Price' => 30000,
                'Quantity' => 3,
                'Amount' => 90000,
                'Tax' => 'vat10',
            ],
        ],
    ],
]);
// или
$request = new InitPaymentRequest(
    amount: 140000,
    orderId: '21090',
    description: 'Подарочная карта на 1000 рублей',
    data: [
        'Phone' => '+71234567890',
        'Email' => 'a@test.com',
    ],
    receipt: new Receipt(
        email: 'a@test.ru',
        phone: '+79031234567',
        taxation: TaxationEnum::Osn,
        items: ReceiptItemCollection::factory()
            ->add(new ReceiptItem(
                name: 'Наименование товара 1',
                price: 10000,
                quantity: 1,
                amount: 10000,
                tax: VatEnum::Vat10,
                ean13: '303130323930303030630333435',
            ))
            ->add(new ReceiptItem(
                name: 'Наименование товара 2',
                price: 20000,
                quantity: 2,
                amount: 40000,
                tax: VatEnum::Vat20,
            ))
            ->add(new ReceiptItem(
                name: 'Наименование товара 3',
                price: 30000,
                quantity: 3,
                amount: 90000,
                tax: VatEnum::Vat10,
            )),
    ),
);
$response = $paymentService->init($request);



// инициализация выплаты на карту
$request = InitPayoutRequest::factory([
    'OrderId' => 'autoOrd1615285401068DELb',
    'Amount' => 1751,
    'CardId' => '67321574',
]);
// или
$request = new InitPayoutRequest(
    orderId: 'autoOrd1615285401068DELb',
    amount: 1751,
    cardId: '67321574',
);
$response = $paymentService->init($request);



// подтверждение выплаты
$request = PaymentRequest::factory([
    'PaymentId' => '700000085140',
]);
// или
$request = new PaymentRequest(
    paymentId: '700000085140',
);
$response = $paymentService->payment($request);



// проверить статус платежа
$request = StateRequest::factory([
    'PaymentId' => '700000085101',
]);
// или
$request = new StateRequest(
    paymentId: '700000085101',
);
$response = $paymentService->state($request);
```
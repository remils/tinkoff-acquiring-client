<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\PaymentMethod;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\PaymentObject;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\Taxation;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\Vat;
use SergeyZatulivetrov\TinkoffAcquiring\Data\CardData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\FinishAuthorize;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Init;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Receipt;

class DataTest extends TestCase
{
    public function testData(): void
    {
        $data = new Init();
        $data->TerminalKey = "TinkoffBankTest";
        $data->Amount = "140000";
        $data->OrderId = "21050";
        $data->Description = "Gift card for 1400.00 rubles";
        $data->DATA = [
            "Phone" => "+71234567890",
            "Email" => "a@test.com"
        ];
        $data->Receipt = new Receipt();
        $data->Receipt->Email = "a@test.ru";
        $data->Receipt->Phone = "+79031234567";
        $data->Receipt->EmailCompany = "b@test.ru";
        $data->Receipt->Taxation = Taxation::OSN;

        $data->Receipt->initItems(3);

        $data->Receipt->getItem(0)->Name = "Product name 1.";
        $data->Receipt->getItem(0)->Price = 10000;
        $data->Receipt->getItem(0)->Quantity = 1.00;
        $data->Receipt->getItem(0)->Amount = 10000;
        $data->Receipt->getItem(0)->PaymentMethod = PaymentMethod::FULL_PREPAYMENT;
        $data->Receipt->getItem(0)->PaymentObject = PaymentObject::COMMODITY;
        $data->Receipt->getItem(0)->Tax = Vat::VAT10;
        $data->Receipt->getItem(0)->Ean13 = "0123456789";

        $data->Receipt->getItem(1)->Name = "Product Name 2.";
        $data->Receipt->getItem(1)->Price = 20000;
        $data->Receipt->getItem(1)->Quantity = 2.00;
        $data->Receipt->getItem(1)->Amount = 40000;
        $data->Receipt->getItem(1)->PaymentMethod = PaymentMethod::PREPAYMENT;
        $data->Receipt->getItem(1)->PaymentObject = PaymentObject::SERVICE;
        $data->Receipt->getItem(1)->Tax = Vat::VAT20;

        $data->Receipt->getItem(2)->Name = "Product Name 3.";
        $data->Receipt->getItem(2)->Price = 30000;
        $data->Receipt->getItem(2)->Quantity = 3.00;
        $data->Receipt->getItem(2)->Amount = 90000;
        $data->Receipt->getItem(2)->Tax = Vat::VAT10;

        $this->assertEquals([
            "TerminalKey" => "TinkoffBankTest",
            "Amount" => "140000",
            "OrderId" => "21050",
            "Description" => "Gift card for 1400.00 rubles",
            "DATA" => [
                "Phone" => "+71234567890",
                "Email" => "a@test.com"
            ],
            "Receipt" => [
                "Email" => "a@test.ru",
                "Phone" => "+79031234567",
                "EmailCompany" => "b@test.ru",
                "Taxation" => "osn",
                "Items" => [
                    [
                        "Name" => "Product name 1.",
                        "Price" => 10000,
                        "Quantity" => 1.00,
                        "Amount" => 10000,
                        "PaymentMethod" => "full_prepayment",
                        "PaymentObject" => "commodity",
                        "Tax" => "vat10",
                        "Ean13" => "0123456789"
                    ],
                    [
                        "Name" => "Product Name 2.",
                        "Price" => 20000,
                        "Quantity" => 2.00,
                        "Amount" => 40000,
                        "PaymentMethod" => "prepayment",
                        "PaymentObject" => "service",
                        "Tax" => "vat20"
                    ],
                    [
                        "Name" => "Product Name 3.",
                        "Price" => 30000,
                        "Quantity" => 3.00,
                        "Amount" => 90000,
                        "Tax" => "vat10"
                    ]
                ]
            ]
        ], $data->toArray());
    }

    public function testEncryptCardData(): void
    {
        $privateKey = openssl_pkey_new();
        $publicKey  = openssl_pkey_get_details($privateKey)['key'];

        $cardData = new CardData();
        $cardData->PAN        = 4300000000000777;
        $cardData->ExpDate    = "0519";
        $cardData->CardHolder = "IVAN PETROV";
        $cardData->CVV        = "111";

        $data = new FinishAuthorize();
        $data->encodeCardData($publicKey, $cardData);

        openssl_private_decrypt(base64_decode($data->CardData), $decrypted, openssl_get_privatekey($privateKey));

        $this->assertEquals("PAN=4300000000000777;ExpDate=0519;CardHolder=IVAN PETROV;CVV=111", $decrypted);
    }
}

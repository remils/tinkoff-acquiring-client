<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\PaymentMethod;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\PaymentObject;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\Taxation;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\Vat;
use SergeyZatulivetrov\TinkoffAcquiring\Data\CancelData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ConfirmData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetStateData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\InitData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ItemData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ReceiptData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ResendData;

class TestData extends TestCase
{
    public function testInitData()
    {
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

        $array = [
            "TerminalKey" => "TestB",
            "Amount"      => 140000,
            "OrderId"     => "21050",
            "Description" => "Подарочная карта на 1400.00 рублей",
            "DATA"        => [

                "Phone" => "+71234567890",
                "Email" => "a@test.com",
            ],

            "Receipt" => [
                "Email"        => "a@test.ru",
                "Phone"        => "+79031234567",
                "EmailCompany" => "b@test.ru",
                "Taxation"     => "osn",
                "Items"        => [
                    [
                        "Name"          => "Наименование товара 1",
                        "Price"         => 10000,
                        "Quantity"      => 1.00,
                        "Amount"        => 10000,
                        "PaymentMethod" => "full_prepayment",
                        "PaymentObject" => "commodity",
                        "Tax"           => "vat10",
                        "Ean13"         => "0123456789",
                    ],
                    [
                        "Name"          => "Наименование товара 2",
                        "Price"         => 20000,
                        "Quantity"      => 2.00,
                        "Amount"        => 40000,
                        "PaymentMethod" => "prepayment",
                        "PaymentObject" => "service",
                        "Tax"           => "vat20",
                    ],
                    [
                        "Name"     => "Наименование товара 3",
                        "Price"    => 30000,
                        "Quantity" => 3.00,
                        "Amount"   => 90000,
                        "Tax"      => "vat10",
                    ],
                ],
            ],
        ];

        $this->assertEquals($data->toArray(), $array);
    }

    public function testConfirmData()
    {
        $data = new ConfirmData();

        $data->TerminalKey = "TinkoffBankTest";
        $data->PaymentId   = "2164657";
        $data->generateToken("password");

        $array = [
            "TerminalKey" => "TinkoffBankTest",
            "PaymentId"   => "2164657",
            "Token"       => "3cb13992b28bc106867e32c9a1a9185f9715860c09d21f91b3ab5dcc5dfe211b",
        ];

        $this->assertEquals($data->toArray(), $array);
    }

    public function testCancelData()
    {
        $data = new CancelData();

        $data->TerminalKey = "TinkoffBankTest";
        $data->PaymentId   = "2164657";
        $data->generateToken("password");

        $array = [
            "TerminalKey" => "TinkoffBankTest",
            "PaymentId"   => "2164657",
            "Token"       => "3cb13992b28bc106867e32c9a1a9185f9715860c09d21f91b3ab5dcc5dfe211b",
        ];

        $this->assertEquals($data->toArray(), $array);
    }

    public function testGetStateData()
    {
        $data = new GetStateData();

        $data->TerminalKey = "TinkoffBankTest";
        $data->PaymentId   = "2164657";
        $data->generateToken("password");

        $array = [
            "TerminalKey" => "TinkoffBankTest",
            "PaymentId"   => "2164657",
            "Token"       => "3cb13992b28bc106867e32c9a1a9185f9715860c09d21f91b3ab5dcc5dfe211b",
        ];

        $this->assertEquals($data->toArray(), $array);
    }

    public function testResendData()
    {
        $data = new ResendData();

        $data->TerminalKey = "TinkoffBankTest";
        $data->generateToken("password");

        $array = [
            "TerminalKey" => "TinkoffBankTest",
            "Token"       => "79e28c81bdd95b8a8a2d4778aa40978e54161a9ed261ac76de8f5d03f2fd78c0",
        ];

        $this->assertEquals($data->toArray(), $array);
    }
}

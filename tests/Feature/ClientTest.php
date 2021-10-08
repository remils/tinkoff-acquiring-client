<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Feature;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Client;
use SergeyZatulivetrov\TinkoffAcquiring\Data\AddCustomer;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Cancel;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Charge;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Confirm;
use SergeyZatulivetrov\TinkoffAcquiring\Data\FinishAuthorize;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetCardList;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetCustomer;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetState;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Init;
use SergeyZatulivetrov\TinkoffAcquiring\Data\RemoveCard;
use SergeyZatulivetrov\TinkoffAcquiring\Data\RemoveCustomer;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Resend;
use SergeyZatulivetrov\TinkoffAcquiring\Data\SendClosingReceipt;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Submit3DSAuthorization;

class ClientTest extends TestCase
{
    /** @var MockObject|Client $client */
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->getMockBuilder(Client::class)->getMock();
    }

    public function testInit(): void
    {
        $this->client->method('init')->willReturn(['status' => 200]);

        $res = $this->client->init(new Init());

        $this->assertEquals(['status' => 200], $res);
    }


    public function testFinishAuthorize(): void
    {
        $this->client->method('finishAuthorize')->willReturn(['status' => 200]);

        $res = $this->client->finishAuthorize(new FinishAuthorize());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testConfirm(): void
    {
        $this->client->method('confirm')->willReturn(['status' => 200]);

        $res = $this->client->confirm(new Confirm());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testCancel(): void
    {
        $this->client->method('cancel')->willReturn(['status' => 200]);

        $res = $this->client->cancel(new Cancel());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testGetState(): void
    {
        $this->client->method('getState')->willReturn(['status' => 200]);

        $res = $this->client->getState(new GetState());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testResend(): void
    {
        $this->client->method('resend')->willReturn(['status' => 200]);

        $res = $this->client->resend(new Resend());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testSubmit3DSAuthorization(): void
    {
        $this->client->method('submit3DSAuthorization')->willReturn(['status' => 200]);

        $res = $this->client->submit3DSAuthorization(new Submit3DSAuthorization());

        $this->assertEquals(['status' => 200], $res);
    }


    public function testSendClosingReceipt(): void
    {
        $this->client->method('sendClosingReceipt')->willReturn(['status' => 200]);

        $res = $this->client->sendClosingReceipt(new SendClosingReceipt());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testCharge(): void
    {
        $this->client->method('charge')->willReturn(['status' => 200]);

        $res = $this->client->charge(new Charge());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testAddCustomer(): void
    {
        $this->client->method('addCustomer')->willReturn(['status' => 200]);

        $res = $this->client->addCustomer(new AddCustomer());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testGetCustomer(): void
    {
        $this->client->method('getCustomer')->willReturn(['status' => 200]);

        $res = $this->client->getCustomer(new GetCustomer());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testRemoveCustomer(): void
    {
        $this->client->method('removeCustomer')->willReturn(['status' => 200]);

        $res = $this->client->removeCustomer(new RemoveCustomer());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testGetCardList(): void
    {
        $this->client->method('getCardList')->willReturn(['status' => 200]);

        $res = $this->client->getCardList(new GetCardList());

        $this->assertEquals(['status' => 200], $res);
    }

    public function testRemoveCard(): void
    {
        $this->client->method('removeCard')->willReturn(['status' => 200]);

        $res = $this->client->removeCard(new RemoveCard());

        $this->assertEquals(['status' => 200], $res);
    }
}

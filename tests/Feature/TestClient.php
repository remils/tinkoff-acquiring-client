<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Feature;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Client;
use SergeyZatulivetrov\TinkoffAcquiring\Data\CancelData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ConfirmData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetStateData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\InitData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ResendData;

class TestClient extends TestCase
{
    /** @var MockObject|Client $client */
    private $client;

    protected function setUp()
    {
        parent::setUp();

        $this->client = $this->getMockBuilder(Client::class)
            ->setMethods(['execute'])
            ->getMock();

        $this->client->method('execute')
            ->willReturn(['status' => 200]);
    }

    public function testInit()
    {
        $res = $this->client->init(new InitData());

        $this->assertEquals(200, $res['status']);
    }

    public function testConfirm()
    {
        $res = $this->client->confirm(new ConfirmData());

        $this->assertEquals(200, $res['status']);
    }

    public function testCancel()
    {
        $res = $this->client->cancel(new CancelData());

        $this->assertEquals(200, $res['status']);
    }

    public function testGetState()
    {
        $res = $this->client->getState(new GetStateData());

        $this->assertEquals(200, $res['status']);
    }

    public function testResend()
    {
        $res = $this->client->resend(new ResendData());

        $this->assertEquals(200, $res['status']);
    }
}

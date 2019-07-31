<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests;

use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Client;

/**
 * Class ClientTest
 * @package SergeyZatulivetrov\TinkoffAcquiring\Tests
 */
class TestClientConnect extends TestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testClientConnectInit()
    {
        $client = new Client();
        $res    = $client->init();
        $this->assertTrue($res['status'] === 200);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testClientConnectConfirm()
    {
        $client = new Client();
        $res    = $client->confirm();
        $this->assertTrue($res['status'] === 200);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testClientConnectCancel()
    {
        $client = new Client();
        $res    = $client->cancel();
        $this->assertTrue($res['status'] === 200);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testClientConnectGetState()
    {
        $client = new Client();
        $res    = $client->getState();
        $this->assertTrue($res['status'] === 200);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testClientConnectResend()
    {
        $client = new Client();
        $res    = $client->resend();
        $this->assertTrue($res['status'] === 200);
    }
}
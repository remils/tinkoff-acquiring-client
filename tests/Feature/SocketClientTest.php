<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\SocketClient;

class SocketClientTest extends TestCase
{
    #[Test]
    public function tinkoffException(): void
    {
        $this->expectException(TinkoffException::class);
        $this->expectExceptionMessage('Неверные параметры.');

        $client = new SocketClient(
            host: 'securepay.tinkoff.ru',
            port: 443,
            apiUrl: 'v2',
            ssl: true,
            timeout: 30,
        );

        $data = [
            "TerminalKey" => "TinkoffBankTest",
            "PaymentId" => "13660",
            "Token" => "7241ac8307f349afb7bb9dda760717721bbb45950b97c67289f23d8c69cc7b96",
            "IP" => "192.168.0.52"
        ];

        $client->execute('GetState', $data);
    }
}

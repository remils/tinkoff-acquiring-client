<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Client;

use Generator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Wrapper\LoggerWrapper;

class LoggerUnitTest extends TestCase
{
    #[Test]
    public function logger(): void
    {
        $expectedMessageList = $this->expectedMessageList();
        $expectedMessageList->rewind();

        $expectedContextList = $this->expectedContextList();
        $expectedContextList->rewind();

        $client = $this->createMock(ClientInterface::class);
        $client->method('execute')->willReturn([
            'ResponseKey' => 'ResponseValue'
        ]);

        $logger = $this->createMock(LoggerInterface::class);
        // @phpcs:ignore
        $logger->method('debug')->willReturnCallback(function (string $message, array $context) use ($expectedMessageList, $expectedContextList) {
            $this->assertEquals($expectedMessageList->current(), $message);
            $this->assertEquals($expectedContextList->current(), $context);
            $expectedMessageList->next();
            $expectedContextList->next();
        });

        $wrapper = new LoggerWrapper(
            $client,
            $logger,
        );

        $wrapper->execute('Action', ['RequestKey' => 'RequestValue']);
    }

    protected function expectedMessageList(): Generator
    {
        yield 'TINKOFF_ACQUIRING: request "Action"';
        yield 'TINKOFF_ACQUIRING: response "Action"';
    }

    protected function expectedContextList(): Generator
    {
        yield ['RequestKey' => 'RequestValue'];
        yield ['ResponseKey' => 'ResponseValue'];
    }
}

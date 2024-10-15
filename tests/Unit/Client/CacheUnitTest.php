<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Client;

use DateInterval;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\CacheWrapperClient;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;

class CacheUnitTest extends TestCase
{
    #[Test]
    public function saveDataToCache(): void
    {
        $cache = $this->createMock(CacheItemPoolInterface::class);

        $cache->method('getItem')->willReturnCallback(function (string $key): CacheItemInterface {
            $this->assertEquals(hash('sha256', 'ActionName|1|3|5|7|11|Value1|Value2|Value3'), $key);

            $item = $this->createMock(CacheItemInterface::class);

            $item->method('expiresAfter')->willReturnCallback(function ($value) use ($item): CacheItemInterface {
                $this->assertInstanceOf(DateInterval::class, $value);
                $this->assertEquals(new DateInterval('PT30M'), $value);

                return $item;
            });

            $item->method('isHit')->willReturn(false);

            $item->method('get')->willReturn('CacheData');

            return $item;
        });

        $cache->method('save')->willReturnCallback(function ($item): bool {
            $this->assertInstanceOf(CacheItemInterface::class, $item);
            $this->assertEquals('CacheData', $item->get());

            return true;
        });

        $client = $this->createMock(ClientInterface::class);

        $client->method('execute')->willReturnCallback(function (string $action, array $data): array {
            $this->assertEquals('ActionName', $action);
            $this->assertEquals([
                'Key3' => 'Value3',
                'Key2' => 'Value2',
                'Key1' => 'Value1',
                'Items' => [1,3,5,7,11],
            ], $data);

            return [
                'Name' => 'Sergey',
                'Data' => '2024-10-15',
            ];
        });

        $cacheWrapperClient = new CacheWrapperClient(
            client: $client,
            cache: $cache,
            expiresAfter: new DateInterval('PT30M'),
        );

        $response = $cacheWrapperClient->execute('ActionName', [
            'Key3' => 'Value3',
            'Key2' => 'Value2',
            'Key1' => 'Value1',
            'Items' => [1,3,5,7,11],
        ]);

        $this->assertEquals([
            'Name' => 'Sergey',
            'Data' => '2024-10-15',
        ], $response);
    }

    #[Test]
    public function getDataFromCache(): void
    {
        $cache = $this->createMock(CacheItemPoolInterface::class);

        $cache->method('getItem')->willReturnCallback(function (string $key): CacheItemInterface {
            $this->assertEquals(hash('sha256', 'ActionName|1|3|5|7|11|Value1|Value2|Value3'), $key);

            $item = $this->createMock(CacheItemInterface::class);

            $item->method('isHit')->willReturn(true);

            $item->method('get')->willReturn([
                'Name' => 'Sergey',
                'Data' => '2024-10-15',
            ]);

            return $item;
        });

        $client = $this->createMock(ClientInterface::class);

        $cacheWrapperClient = new CacheWrapperClient(
            client: $client,
            cache: $cache,
        );

        $response = $cacheWrapperClient->execute('ActionName', [
            'Key3' => 'Value3',
            'Key2' => 'Value2',
            'Key1' => 'Value1',
            'Items' => [1,3,5,7,11],
        ]);

        $this->assertEquals([
            'Name' => 'Sergey',
            'Data' => '2024-10-15',
        ], $response);
    }
}

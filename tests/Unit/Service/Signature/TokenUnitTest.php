<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Service\Signature;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\TokenService;

class TokenUnitTest extends TestCase
{
    #[Test]
    public function generated(): void
    {
        $service = new TokenService(
            'TestBank',
            'TestPassword',
            ['DATA']
        );

        $this->assertInstanceOf(SignatureServiceInterface::class, $service);

        $this->assertEquals([
            'TerminalKey' => 'TestBank',
            'Token'       => 'cdc3ced376c25d0a7e827ca2f5b64b56ade12b6b799b32d35ae0af49d7727a44',
        ], $service->signedRequest([
            'Amount' => 123,
            'DATA' => [
                'Email' => 'test@mail.loc',
            ],
        ]));
    }
}

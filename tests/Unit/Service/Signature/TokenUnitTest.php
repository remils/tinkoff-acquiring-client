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
        $service = new TokenService('TestPassword', ['Array']);

        $this->assertInstanceOf(SignatureServiceInterface::class, $service);

        $data = [
            'X' => 245,
            'A' => 176,
            'P' => 111,
            'Array' => [1,2,3,4,5]
        ];

        $data = $service->signedRequest($data);

        $this->assertEquals([1, 2, 3, 4, 5], $data['Array']);

        $this->assertEquals(
            hash('sha256', '176111TestPassword245'),
            $data['Token'],
        );
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Tests\Unit\Service\Signature;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\CertificateService;

class CertificateUnitTest extends TestCase
{
    #[Test]
    public function generated(): void
    {
        $privateKey = "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC+Sv1D+z6tLXcY
ZOyUi/br5Mzr16ZF8By+xoj7cf7eCc+g6zbTvb7DJwULTqAhuQCoDOVrNionkVfZ
bpX8p7kYTIRf3rtoQSsIa9plZ5YUOFQgQH/OoANEUagg/j/Fn0qsVkSJ+Qnnd7zP
GAhnhnNqeruZNpue9b4ClqCWow1ppGtwQCztWRUim74eU83qRS6UNqqNJie7wui1
EBbZTOpwV5nQvK5OIh4djjdlvppqbhVByAGm4RIDTOuOpC6stYxaQVqYYtEQX5r4
iO6IBDgXTl7e4E1LofMN671ySZUx873lRDCNIBFtgWaVr2Kltncum4vxpI37HIdD
6Z6WOqkfAgMBAAECggEAHQaaOB7gMhEvy9hFH+lzigrV2RmFQsC72bu11EjQm/S6
J20JaWXVbbYLdmyRT2OFPpzs95wE9REd6cwM88Nvn824GVmDk4TxN/EfmH0i7sWi
y2KbPBy7MtYTw6iUeKPyA3SLMtJ6WMSyV5JuYcAn5bN/3wBt32LTj1iDeUa4uoa3
CMgr7oD8u5wG3OkupRSt14bAi/mt61z8wFnAWJsNn57X8JyzTvVE7+BOxHZ078LS
4RWz4dVVKnWDCbYMquQ0KsdxGGmSXWAHYOiGf7L7JFawP/zbUVXj/yH5JE1eLGg8
mJmiY217oH+m46K9YmRXiy4SletptRjAFHXWuceE2QKBgQDeevptrigp8rMmi42X
uXUburEL71xxz9V0E7Y4pTdJ3bpIw4j2Ay80IUxFcGlZiata+Sh3lWgnpeN3Iq9C
QfjDtxUSs7q46heG9i8JAtoDvQ5EJeyS5LrxQXut7wtig9efFDpSrV11OUGgfY/v
IZJUk312io6hVPeRY4HmfLuy5wKBgQDa9owxHNNwnsNbe8a48XyAMdhIkH23/qz7
ahY6y9vL3DcseGXGT0MSn4IrM0M26Rb2+rFqTKYt6fMJ/DJtMXDQMUY51m0zDZjk
v9wlaKZZF90PODNE2hYOE9YXrMSEgar0TAuYeOElwBRobA2M0IBUP5NGtoMKe7LX
pxGar0bJCQKBgCVGLVba6te8Vc+LafmVlM1Ehg0d2TsoOvbrpofvBkhV4bP3Lqco
+WueeIzZvIzHx/HB9Mm0OnMKFAYNxZcwPmFr9xffDNWWQsLV1COKWsRtlEpOoEgs
EjYBZptJhXrH5AQ++1aGvTW6lggxgT/rO/z3iPmnVSYqeh/dsBHRrBDZAoGAWW1E
SHKrcF2HD//3Y2VNIdY5rTlF/zWGVJA5T/4eYJ4p8oGhn2KT1DFNKnOfSffcpzYv
62gunqXj2vojZjFBD+Zv9gM7ShSNky9ArA6Xkd+LK0Iavk4Ln+g+EiE/iZajyW6d
dcI4wgA21Yb76bzmDIKClejIkCmBG05ihDh9wnECgYEAtzl9QZCrUyMVW3+tJMEp
703aLwfB9bwBXe0dU81mDA4n/U2FoRWRY0eDWJgX1WWnxdq1QKPIUB5rxBl2LYp9
LvARp9c9b/h0JIZZD4e/B3awpJf8bnPCLko3p5TzPGisBOqMZgQBTYsO9mkvt6Yb
a8RAxBp4DaVrnMG2q0B9kV8=
-----END PRIVATE KEY-----";

        $service = new CertificateService(
            terminalKey: 'TestBank',
            serialNumber: 'TestSerialNumber',
            privateKey: $privateKey,
            excludedProperties: ['DATA']
        );

        $this->assertEquals([
            'TerminalKey'      => 'TestBank',
            'X509SerialNumber' => 'TestSerialNumber',
            'DigestValue'      => 'Ml6k3HZY88voGlpri22LS4Ve1DpFZBCFFXu014pthnE=',
            'SignatureValue'   => 'eX1JFMCPAofaBynb8MI2lPoUjtnj84hVrpqgRswYQVHKx98dXdtzvuNhBDBhZ8QOdr0DwFpPXF/Zkc' .
                                  '3YDqZG8dGCfU7v7iOUmNIBEzlGtqwFPjL+RtwVDtRplsoOZhDF4jaeDrbII2eEIeaVc20IPpzOdqBN' .
                                  'vFN0FTWvU9fiklh6mPNz1pexK765okeO+Ji56VR4RN/Jchc5C13U6WyF0U/PXe3/H6a0ow3KpdFd1U' .
                                  'WHeUnnbqh0nG4HJxUgNy7Fd25fhnaR7/Xtf2ARiuvb1weoAXHzWczqcTH8UE1xdnoq4u/WOfAvDFCN' .
                                  '3vKpOeKAuLHKMni4mqOiSwhHLUWNHg=='
        ], $service->signedRequest([
            'Amount' => 123,
            'DATA' => [
                'Email' => 'test@mail.loc',
            ],
        ]));
    }
}

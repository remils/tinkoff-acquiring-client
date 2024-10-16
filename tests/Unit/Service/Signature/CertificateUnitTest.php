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
            serialNumber: 'TestSerialNumber',
            privateKey: $privateKey,
            excludedProperties: ['Data']
        );

        $data = [
            'TerminalKey' => 'TestBank',
            'Data' => [
                'Email' => 'test@mail.loc',
            ],
        ];

        $data = $service->signedRequest($data);

        $this->assertEquals([
            'X509SerialNumber' => 'TestSerialNumber',
            'DigestValue' => 'Ao/gPAlaGsJ7FBib+iLbAUR57gatHfzK57xKGCKNXhM=',
            'SignatureValue' => 'hZPMNjsrI5lkRso1aOW/t7T3Yt7wHRsnneuOVNW9nL8YJ5bNFWuNMEADalAQPrJ22IvBzc6D9JF9' .
                                'F27XHgeFtdNO76aJ6ZPC/Q7eqRemp5SyOuYC3rOhk19H+TUKxCRp8K5QZfhnlx0zMN5w5J5CTb8C' .
                                'k3bKAFykN4XQgC2QtRL9Vp242K5zeWaanNxKyU+ceZSizR5zLJzYIHMuE2tlx8khpPiUmL1mi6DQ' .
                                'YI0ARjHdgH9rRxd5Vw9tMCXVDJaocdLDfxw6ZhxnFGDwdlOxFMwVxt3t6zSlL27znvPeVhPj8OHG' .
                                'RB6Es/qgc0kd19mLUZvi+64Rts3xfR9bZkgzUw==',
            'TerminalKey' => 'TestBank',
            'Data' => [
                'Email' => 'test@mail.loc',
            ],
        ], $data);
    }
}

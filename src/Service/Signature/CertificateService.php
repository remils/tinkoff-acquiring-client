<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CertificateService
 */
class CertificateService implements SignatureServiceInterface
{
    /**
     * @param string $serialNumber Серийный номер сертификата
     * @param string $privateKey Значение приватного ключа
     * @param string[] $excludedProperties Свойства запроса, которые будут исключены при генерации подписи
     */
    public function __construct(
        protected readonly string $serialNumber,
        protected readonly string $privateKey,
        protected readonly array $excludedProperties = [
            'DigestValue',
            'SignatureValue',
            'X509SerialNumber',
            'DATA',
        ],
    ) {
    }

    /**
     * @inheritDoc
     */
    public function signedRequest(array $data): array
    {
        $hashBinary = $this->getHashBinary($data);

        $data['X509SerialNumber'] = $this->serialNumber;
        $data['DigestValue'] = base64_encode($hashBinary);
        $data['SignatureValue'] = base64_encode($this->signPrivateKey($hashBinary));

        return $data;
    }

    /**
     * Подписывает бинарную хеш-сумму сертификатом
     * @param string $hashBinary
     * @return string
     */
    protected function signPrivateKey(string $hashBinary): string
    {
        openssl_sign(
            $hashBinary,
            $signatureValue,
            $this->privateKey,
            OPENSSL_ALGO_SHA256
        );

        return $signatureValue;
    }

    /**
     * Вычислить хэш-сумму по алгоритму SHA256 и получить результат в бинарном виде
     * @param array<string,mixed> $data
     * @return string
     */
    protected function getHashBinary(array $data): string
    {
        if (count($this->excludedProperties)) {
            foreach (array_keys($data) as $key) {
                if (in_array($key, $this->excludedProperties)) {
                    unset($data[$key]);
                }
            }
        }

        ksort($data, SORT_STRING);

        return hash('sha256', join('', $data), true);
    }
}

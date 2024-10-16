<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service\Signature;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CertificateService
 *
 * @phpstan-type TSignatureData array{
 *      X509SerialNumber: string,
 *      DigestValue: string,
 *      SignatureValue: string
 * }
 *
 * @implements SignatureServiceInterface<TSignatureData>
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

        /**
         * @var TSignatureData $signatureData
         */
        $signatureData = [
            'X509SerialNumber' => $this->serialNumber,
            'DigestValue' => base64_encode($hashBinary),
            'SignatureValue' => base64_encode($this->signPrivateKey($hashBinary)),
        ];

        return array_merge($signatureData, $data);
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
     *
     * @template TData of array<string,mixed>
     *
     * @param TData $data
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

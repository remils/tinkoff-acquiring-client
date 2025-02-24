<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service\Signature;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * CertificateService
 *
 * @phpstan-type T array{
 *      TerminalKey:      string,
 *      X509SerialNumber: string,
 *      DigestValue:      string,
 *      SignatureValue:   string
 * }
 * @phpstan-implements SignatureServiceInterface<T>
 */
class CertificateService implements SignatureServiceInterface
{
    /**
     * @param string   $terminalKey        Идентификатор терминала
     * @param string   $serialNumber       Серийный номер сертификата
     * @param string   $privateKey         Значение приватного ключа
     * @param string[] $excludedProperties Свойства запроса, которые будут исключены при генерации подписи
     */
    public function __construct(
        protected readonly string $terminalKey,
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

    public function signedRequest(array $data): array
    {
        /**
         * @var T
         */
        $signatureData = [];

        $hashBinary = $this->getHashBinary($data);

        $signatureData['TerminalKey']      = $this->terminalKey;
        $signatureData['X509SerialNumber'] = $this->serialNumber;
        $signatureData['DigestValue']      = base64_encode($hashBinary);
        $signatureData['SignatureValue']   = base64_encode($this->signPrivateKey($hashBinary));

        return $signatureData;
    }

    /**
     * Подписывает бинарную хеш-сумму сертификатом
     *
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

        $data['TerminalKey'] = $this->terminalKey;

        ksort($data, SORT_STRING);

        return hash('sha256', join('', $data), true);
    }
}

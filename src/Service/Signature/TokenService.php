<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service\Signature;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * TokenService
 *
 * @phpstan-type T array{
 *      TerminalKey: string,
 *      Token:       string
 * }
 * @phpstan-implements SignatureServiceInterface<T>
 */
class TokenService implements SignatureServiceInterface
{
    /**
     * @param string   $terminalKey        Идентификатор терминала
     * @param string   $password           Секретный ключ терминала
     * @param string[] $excludedProperties Свойства запроса, которые будут исключены при генерации подписи
     */
    public function __construct(
        protected readonly string $terminalKey,
        protected readonly string $password,
        protected readonly array $excludedProperties = [
            'Receipt',
            'DATA',
        ],
    ) {
    }

    /**
     * @inheritDoc
     */
    public function signedRequest(array $data): array
    {
        /**
         * @var T
         */
        $signatureData = [];

        $signatureData['TerminalKey'] = $this->terminalKey;
        $signatureData['Token']       = $this->getToken(array_merge(
            [
                'TerminalKey' => $this->terminalKey,
            ],
            $data,
        ));

        return $signatureData;
    }

    /**
     * Генерация токена
     *
     * @param array<string,mixed> $data
     * @return string
     */
    protected function getToken(array $data): string
    {
        if (count($this->excludedProperties)) {
            foreach (array_keys($data) as $key) {
                if (in_array($key, $this->excludedProperties)) {
                    unset($data[$key]);
                }
            }
        }

        $data['Password'] = $this->password;

        ksort($data, SORT_STRING);

        return hash('sha256', join('', $data));
    }
}

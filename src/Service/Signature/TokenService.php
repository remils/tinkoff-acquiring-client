<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service\Signature;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * TokenService
 *
 * @phpstan-type TSignatureData array{
 *      Token: string
 * }
 *
 * @implements SignatureServiceInterface<TSignatureData>
 */
class TokenService implements SignatureServiceInterface
{
    /**
     * @param string $password Секретный ключ терминала
     * @param string[] $excludedProperties Свойства запроса, которые будут исключены при генерации подписи
     */
    public function __construct(
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
        return [
            ...$data,
            'Token' => $this->getToken($data),
        ];
    }

    /**
     * Генерация токена
     *
     * @template TData of array<string,mixed>
     *
     * @param TData $data
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

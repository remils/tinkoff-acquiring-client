<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * TokenService
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
        $data['Token'] = $this->getToken($data);

        return $data;
    }

    /**
     * Генерация токена
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

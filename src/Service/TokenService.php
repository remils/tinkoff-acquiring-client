<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

/**
 * TokenService
 */
class TokenService
{
    /**
     * @param string $password
     * @param string[] $excludedProperties
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
     * @param array<string,mixed> $data
     * @return string
     */
    public function generate(array $data): string
    {
        if (count($this->excludedProperties)) {
            foreach (array_keys($data) as $key) {
                if (in_array($key, $this->excludedProperties)) {
                    unset($data[$key]);
                }
            }
        }

        ksort($data);

        return hash('sha256', join('', $data));
    }
}

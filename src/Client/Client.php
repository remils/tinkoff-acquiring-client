<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Client;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;

/**
 * Client
 *
 * Интернет-эквайринг:
 * - Тестовый URL: https://rest-api-test.tinkoff.ru/v2/
 * - Боевой URL (по умолчанию): https://securepay.tinkoff.ru/v2/
 *
 * Массовые выплаты (неизвестно есть ли тестовый URL):
 * - Боевой URL: https://securepay.tinkoff.ru/e2c/v2/
 *
 * На тестовом URL требуется получить доступ, иначе будет 403 код ошибки.
 */
class Client implements ClientInterface
{
    /**
     * @param string $apiUrl URL для обращения
     */
    public function __construct(
        protected readonly string $apiUrl = 'https://securepay.tinkoff.ru/v2/',
    ) {
    }

    /**
     * @inheritDoc
     * @throws HttpException
     */
    public function execute(string $action, array $data): mixed
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->apiUrl . $action);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $result = curl_exec($curl);
        $code = curl_errno($curl);
        $message = curl_error($curl);

        curl_close($curl);

        if ($code) {
            throw new HttpException($message, $code);
        }

        return json_decode((string)$result, true);
    }
}

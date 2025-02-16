<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Client;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;

/**
 * CurlClient
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
class CurlClient implements ClientInterface
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
     */
    public function execute(string $action, array $data): mixed
    {
        $content = json_encode($data) ?: '';
        $contentLength = mb_strlen($content);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->apiUrl . $action);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Accept: application/json",
            "Content-Type: application/json",
            "Content-Length: {$contentLength}",
            "User-Agent: SergeyZatulivetrov/TinkoffAcquiring 4.0.0",
            "Connection: Close",
        ]);

        $result = strval(curl_exec($curl));
        $status = intval(curl_getinfo($curl, CURLINFO_RESPONSE_CODE));
        $contentLength = intval(curl_getinfo($curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD));

        curl_close($curl);

        if ($status !== 200) {
            throw new HttpException('Network error', $status);
        }

        $content = mb_strcut($result, -$contentLength, $contentLength);

        $response = json_decode($content, true);

        if ($response['Success'] === false) {
            throw new TinkoffException(
                code: intval($response['ErrorCode']),
                message: strval($response['Message']),
                details: strval($response['Details']),
            );
        }

        return $response;
    }
}

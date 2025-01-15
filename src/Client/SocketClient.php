<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Client;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\ClientException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\HttpException;
use SergeyZatulivetrov\TinkoffAcquiring\Client\Exception\TinkoffException;

/**
 * SocketClient
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
class SocketClient implements ClientInterface
{
    /**
     * @param string $host Возможные значения: rest-api-test.tinkoff.ru, securepay.tinkoff.ru
     * @param int $port По умолчанию 443 для обращения к https протоколу
     * @param string $apiUrl Возможные значения: v2, e2c/v2
     * @param bool $ssl Если идет обращение к https протоколу, то установить значение в true
     * @param int $timeout Время соединения с сервером
     */
    public function __construct(
        protected string $host = 'securepay.tinkoff.ru',
        protected int $port = 443,
        protected string $apiUrl = 'v2',
        protected bool $ssl = true,
        protected int $timeout = 30,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(string $action, array $data): mixed
    {
        $socket = $this->socket();

        $content = json_encode($data);

        $message = $this->message($action, $content);

        if (!fwrite($socket, $message)) {
            fclose($socket);

            throw new ClientException('Send error');
        }

        // HTTP/1.1 200 Ok
        $head = explode(" ", fgets($socket), 3);

        $code = (int) ($head[1] ?? 500);
        $status = $head[2] ?? 'Internal error';

        if ($code !== 200) {
            throw new HttpException($status, $code);
        }

        $headers = [];

        while ($str = trim(fgets($socket))) {
            [$key, $value] = explode(':', $str, 2);

            $headers[mb_strtolower($key)] = trim($value);
        }

        $content = fread($socket, (int) $headers['content-length']);

        fclose($socket);

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

    /**
     * @throws ClientException
     * @return resource
     */
    protected function socket()
    {
        if ($this->ssl) {
            $socket = fsockopen("ssl://{$this->host}", $this->port, $errno, $errstr, $this->timeout);
        } else {
            $socket = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
        }

        if (!$socket) {
            throw new ClientException($errstr, $errno);
        }

        return $socket;
    }

    protected function message(string $action, string $content): string
    {
        $contentLength = mb_strlen($content);

        return "POST /{$this->apiUrl}/{$action} HTTP/1.1\r\n"
            . "Host: {$this->host}:{$this->port}\r\n"
            . "Accept: application/json\r\n"
            . "Content-Type: application/json\r\n"
            . "Content-Length: {$contentLength}\r\n"
            . "User-Agent: SergeyZatulivetrov/TinkoffAcquiring 4.0.0\r\n"
            . "Connection: Close\r\n"
            . "\r\n"
            . $content;
    }
}

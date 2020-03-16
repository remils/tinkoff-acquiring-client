<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Traits;

use GuzzleHttp\Client;

/**
 * Trait HttpClient
 * @package SergeyZatulivetrov\TinkoffAcquiring\Traits
 */
trait HttpClient
{
    /**
     * @var string
     */
    public $API_URL = 'https://securepay.tinkoff.ru/v2/';

    /**
     * @var string
     */
    public $HTTP_METHOD = 'POST';

    /**
     * @param       $action
     * @param array $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function execute($action, $data = [])
    {
        $apiURL = $this->API_URL . $action;

        $headers['Content-Type'] = 'application/json';

        $data = \json_encode($data);

        $client   = new Client();
        $res      = $client->request(
            $this->HTTP_METHOD, $apiURL, [
            'headers' => $headers,
            'body'    => $data,
        ]);
        $status   = $res->getStatusCode();
        $response = json_decode($res->getBody()->getContents(), true);

        return [
            'status'   => $status,
            'response' => $response,
        ];
    }
}

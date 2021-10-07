<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring;

use GuzzleHttp\Client as HttpClient;
use SergeyZatulivetrov\TinkoffAcquiring\Contracts\ClientContract;
use SergeyZatulivetrov\TinkoffAcquiring\Contracts\DataContract;
use SergeyZatulivetrov\TinkoffAcquiring\Data\CancelData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ConfirmData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetStateData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\InitData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ResendData;

class Client implements ClientContract
{
    const API_URL = 'https://securepay.tinkoff.ru/v2/';

    public function init(InitData $data): array
    {
        return $this->execute('Init', $data);
    }

    public function confirm(ConfirmData $data): array
    {
        return $this->execute('Confirm', $data);
    }

    public function cancel(CancelData $data): array
    {
        return $this->execute('Cancel', $data);
    }

    public function getState(GetStateData $data): array
    {
        return $this->execute('GetState', $data);
    }

    public function resend(ResendData $data): array
    {
        return $this->execute('Resend', $data);
    }

    public function execute(string $action, DataContract $data): array
    {
        $client = new HttpClient();

        $response = $client->request(
            'POST',
            self::API_URL . $action,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body'    => json_encode($data->toArray()),
            ]
        );

        return [
            'status' => $response->getStatusCode(),
            'response' => json_decode($response->getBody()->getContents(), true),
        ];
    }
}

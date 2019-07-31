<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring;

use SergeyZatulivetrov\TinkoffAcquiring\Interfaces\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Traits\HttpClient;

/**
 * Class Client
 * @package SergeyZatulivetrov\TinkoffAcquiring
 */
class Client implements ClientInterface
{
    use HttpClient;

    /**
     * @param array $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function init($data = [])
    {
        return $this->execute('Init', $data);
    }

    /**
     * @param array $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function confirm($data = [])
    {
        return $this->execute('Confirm', $data);
    }

    /**
     * @param array $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancel($data = [])
    {
        return $this->execute('Cancel', $data);
    }

    /**
     * @param array $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getState($data = [])
    {
        return $this->execute('GetState', $data);
    }

    /**
     * @param array $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function resend($data = [])
    {
        return $this->execute('Resend', $data);
    }
}
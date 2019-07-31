<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Interfaces;

/**
 * Interface ClientInterface
 * @package SergeyZatulivetrov\TinkoffAcquiring\Interfaces
 */
interface ClientInterface
{
    /**
     * @param $data
     *
     * @return mixed
     */
    public function init($data);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function confirm($data);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function cancel($data);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function getState($data);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function resend($data);
}
<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Signature request
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/request-sign/
 *
 * @property string $Token Token
 */
abstract class AbstractDataWithToken extends AbstractData
{
    /**
     * Token generation
     *
     * @param string $password Password
     */
    public function generateToken(string $password): void
    {
        $data = $this->toArray();

        $data['Password'] = $password;

        unset($data['Shops'], $data['Receipt'], $data['DATA']);

        ksort($data);

        $this->Token = hash('sha256', join('', $data));
    }
}

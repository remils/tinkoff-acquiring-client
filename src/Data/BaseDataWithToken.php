<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * @property string $Token
 */
abstract class BaseDataWithToken extends BaseData
{
    public function generateToken($password)
    {
        $data = $this->toArray();

        $data['Password'] = $password;

        unset($data['Receipt'], $data['DATA']);

        ksort($data);

        $token = join('', array_values($data));

        $this->Token = hash('sha256', $token);
    }
}

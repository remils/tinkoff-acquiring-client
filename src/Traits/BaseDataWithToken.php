<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Traits;

/**
 * Trait Token
 *
 * @property string $Token
 */
trait BaseDataWithToken
{
    use BaseData;

    /**
     * @param $password
     */
    public function generateToken($password)
    {
        $data = $this->toArray();

        $data['Password'] = $password;
        unset($data['Receipt'], $data['DATA']);
        ksort($data);

        $token = '';
        foreach ($data as $value) {
            $token .= $value;
        }

        $this->Token = hash('sha256', $token);
    }
}
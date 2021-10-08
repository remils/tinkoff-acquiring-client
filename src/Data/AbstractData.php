<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use SergeyZatulivetrov\TinkoffAcquiring\Contracts\DataContract;

abstract class AbstractData implements DataContract
{
    private $data = [];

    public function toArray(): array
    {
        return $this->converter($this->data);
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __unset($name)
    {
        if (isset($this->data[$name])) {
            unset($this->data[$name]);
        }
    }

    private function converter(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->converter($value);
                continue;
            }
            if ($value instanceof DataContract) {
                $data[$key] = $value->toArray();
            }
        }

        return $data;
    }
}

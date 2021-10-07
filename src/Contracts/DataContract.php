<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Contracts;

interface DataContract
{
    public function toArray(): array;
}

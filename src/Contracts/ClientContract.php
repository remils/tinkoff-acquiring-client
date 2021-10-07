<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Contracts;

use SergeyZatulivetrov\TinkoffAcquiring\Data\CancelData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ConfirmData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetStateData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\InitData;
use SergeyZatulivetrov\TinkoffAcquiring\Data\ResendData;

interface ClientContract
{
    public function init(InitData $data): array;

    public function confirm(ConfirmData $data): array;

    public function cancel(CancelData $data): array;

    public function getState(GetStateData $data): array;

    public function resend(ResendData $data): array;

    public function execute(string $action, DataContract $data): array;
}

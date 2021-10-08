<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Contracts;

use SergeyZatulivetrov\TinkoffAcquiring\Data\AddCustomer;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Cancel;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Charge;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Confirm;
use SergeyZatulivetrov\TinkoffAcquiring\Data\FinishAuthorize;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetCardList;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetCustomer;
use SergeyZatulivetrov\TinkoffAcquiring\Data\GetState;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Init;
use SergeyZatulivetrov\TinkoffAcquiring\Data\RemoveCard;
use SergeyZatulivetrov\TinkoffAcquiring\Data\RemoveCustomer;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Resend;
use SergeyZatulivetrov\TinkoffAcquiring\Data\SendClosingReceipt;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Submit3DSAuthorization;

interface ClientContract
{
    public function init(Init $data): array;

    public function finishAuthorize(FinishAuthorize $data): array;

    public function confirm(Confirm $data): array;

    public function cancel(Cancel $data): array;

    public function getState(GetState $data): array;

    public function resend(Resend $data): array;

    public function submit3DSAuthorization(Submit3DSAuthorization $data): array;

    public function sendClosingReceipt(SendClosingReceipt $data): array;

    public function charge(Charge $data): array;

    public function addCustomer(AddCustomer $data): array;

    public function getCustomer(GetCustomer $data): array;

    public function removeCustomer(RemoveCustomer $data): array;

    public function getCardList(GetCardList $data): array;

    public function removeCard(RemoveCard $data): array;
}

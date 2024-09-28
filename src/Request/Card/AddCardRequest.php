<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\CheckTypeEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Request\RequestInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * AddCardRequest
 *
 * @template TSignatureData of array<string,string>
 *
 * @phpstan-type TData array{
 *      TerminalKey: string,
 *      CustomerKey: string,
 *      IP: string|null,
 *      CheckType: string|null,
 *      ResidentState: bool|null
 * }
 *
 * @implements RequestInterface<TData,TSignatureData>
 */
class AddCardRequest implements RequestInterface
{
    /**
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string|null $ip IP-адрес запроса
     * @param CheckTypeEnum|null $checkType Если CheckType не передается, автоматически проставляется значение NO.
     * - Возможные значения:
     * - 1. NO – сохранить карту без проверок. Rebill ID для рекуррентных платежей не возвращается;
     * - 2. HOLD – при сохранении сделать списание на 0 руб. RebillID возвращается для терминалов без поддержки 3DS.
     * При CheckType = 3DS, для успешной работы метода AttachCard необходимо передать срок действия карты
     * в CardData (параметр ExpDate).
     * - 3. 3DS – при сохранении карты выполнить проверку 3DS и выполнить списание на 0 р. В этом случае RebillID
     * будет только для 3DS карт. Карты, не поддерживающие 3DS, привязаны не будут.
     * - 4. 3DSHOLD – при привязке карты выполняем проверку, поддерживает карта 3DS или нет. Выполняется списание
     * на 0р. Если карта поддерживает 3DS, то операция идет по сценарию 3DS, если не поддерживает - по сценарию HOLD
     * @param bool|null $residentState Признак резидентности добавляемой карты.
     * Возможные значения:
     * - true - Карта РФ,
     * - false - Карта не РФ,
     * - null - Не специфицируется (универсальная карта).
     */
    public function __construct(
        public readonly string $customerKey,
        public readonly ?CheckTypeEnum $checkType = null,
        public readonly ?bool $residentState = null,
        public readonly ?string $ip = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function build(
        string $terminalKey,
        SignatureServiceInterface $signatureService,
    ) {
        /**
         * @var TData $data
         */
        $data = [
            'TerminalKey' => $terminalKey,
            'CustomerKey' => $this->customerKey,
        ];

        if (null !== $this->ip) {
            $data['IP'] = $this->ip;
        }

        if (null !== $this->checkType) {
            $data['CheckType'] = $this->checkType->value;
        }

        if (null !== $this->residentState) {
            $data['ResidentState'] = $this->residentState;
        }

        return $signatureService->signedRequest($data);
    }
}

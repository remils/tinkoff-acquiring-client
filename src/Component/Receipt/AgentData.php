<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Component\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Component\ComponentInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\AgentSignEnum;

/**
 * AgentData
 *
 * @phpstan-type T array{
 *      AgentSign:       ?string,
 *      OperationName:   ?string,
 *      Phones:          ?string[],
 *      ReceiverPhones:  ?string[],
 *      TransferPhones:  ?string[],
 *      OperatorName:    ?string,
 *      OperatorAddress: ?string,
 *      OperatorInn:     ?string
 * }
 * @phpstan-implements ComponentInterface<T>
 */
class AgentData implements ComponentInterface
{
    /**
     * @param ?AgentSignEnum $agentSign       Признак агента
     * @param ?string        $operationName   Наименование операции
     * @param ?string[]      $phones          Телефоны платежного агента, в формате +{Ц}
     * @param ?string[]      $receiverPhones  Телефоны оператора по приему платежей, в формате +{Ц}
     * @param ?string[]      $transferPhones  Телефоны оператора перевода, в формате +{Ц}
     * @param ?string        $operatorName    Наименование оператора перевода
     * @param ?string        $operatorAddress Адрес оператора перевода
     * @param ?string        $operatorInn     ИНН оператора перевода
     */
    public function __construct(
        public readonly ?AgentSignEnum $agentSign = null,
        public readonly ?string $operationName = null,
        public readonly ?array $phones = null,
        public readonly ?array $receiverPhones = null,
        public readonly ?array $transferPhones = null,
        public readonly ?string $operatorName = null,
        public readonly ?string $operatorAddress = null,
        public readonly ?string $operatorInn = null,
    ) {
    }

    public static function factory(array $data): self
    {
        return new AgentData(
            agentSign:       empty($data['AgentSign']) ? null : AgentSignEnum::from($data['AgentSign']),
            operationName:   $data['OperationName'] ?? null,
            phones:          $data['Phones'] ?? null,
            receiverPhones:  $data['ReceiverPhones'] ?? null,
            transferPhones:  $data['TransferPhones'] ?? null,
            operatorName:    $data['OperatorName'] ?? null,
            operatorAddress: $data['OperatorAddress'] ?? null,
            operatorInn:     $data['OperatorInn'] ?? null,
        );
    }

    public function toArray(): array
    {
        /**
         * @var T
         */
        $data = [];

        if (null !== $this->agentSign) {
            $data['AgentSign'] = $this->agentSign->value;
        }

        if (null !== $this->operationName) {
            $data['OperationName'] = $this->operationName;
        }

        if (null !== $this->phones) {
            $data['Phones'] = $this->phones;
        }

        if (null !== $this->receiverPhones) {
            $data['ReceiverPhones'] = $this->receiverPhones;
        }

        if (null !== $this->transferPhones) {
            $data['TransferPhones'] = $this->transferPhones;
        }

        if (null !== $this->operatorName) {
            $data['OperatorName'] = $this->operatorName;
        }

        if (null !== $this->operatorAddress) {
            $data['OperatorAddress'] = $this->operatorAddress;
        }

        if (null !== $this->operatorInn) {
            $data['OperatorInn'] = $this->operatorInn;
        }

        return $data;
    }
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Mapper\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt\AgentData;

/**
 * AgentDataMapper
 *
 * @phpstan-type TItem array{
 *      AgentSign: string|null,
 *      OperationName: string|null,
 *      Phones: string[]|null,
 *      ReceiverPhones: string[]|null,
 *      TransferPhones: string[]|null,
 *      OperatorName: string|null,
 *      OperatorAddress: string|null,
 *      OperatorInn: string|null
 * }
 */
class AgentDataMapper
{
    /**
     * @param AgentData $entity
     * @return TItem
     */
    public function item(AgentData $entity)
    {
        /**
         * @var TItem $data
         */
        $data = [];

        if (null !== $entity->agentSign) {
            $data['AgentSign'] = $entity->agentSign->value;
        }

        if (null !== $entity->operationName) {
            $data['OperationName'] = $entity->operationName;
        }

        if (null !== $entity->phones) {
            $data['Phones'] = $entity->phones;
        }

        if (null !== $entity->receiverPhones) {
            $data['ReceiverPhones'] = $entity->receiverPhones;
        }

        if (null !== $entity->transferPhones) {
            $data['TransferPhones'] = $entity->transferPhones;
        }

        if (null !== $entity->operatorName) {
            $data['OperatorName'] = $entity->operatorName;
        }

        if (null !== $entity->operatorAddress) {
            $data['OperatorAddress'] = $entity->operatorAddress;
        }

        if (null !== $entity) {
            $data['OperatorInn'] = $entity->operatorInn;
        }

        return $data;
    }
}

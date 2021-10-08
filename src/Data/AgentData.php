<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

/**
 * Agent data
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/init-request/#AgentData
 *
 * @property string   $AgentSign       Sign of agent
 * @property string   $OperationName   The name of the operation
 * @property string[] $Phones          Phones of the payment agent
 * @property string[] $ReceiverPhones  Phone operator for receiving payments
 * @property string[] $TransferPhones  Phones Translation Operator
 * @property string   $OperatorName    Name of transformation operator
 * @property string   $OperatorAddress Alternator address translation
 * @property string   $OperatorInn     Inn Translation Operator
 */
class AgentData extends AbstractData
{
}

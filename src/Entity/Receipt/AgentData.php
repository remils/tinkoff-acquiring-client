<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\AgentSignEnum;

/**
 * AgentData
 */
class AgentData
{
    /**
     * @param AgentSignEnum|null $agentSign Признак агента.
     * Возможные значения:
     * - bank_paying_agent – банковский платежный агент
     * - bank_paying_subagent – банковский платежный субагент
     * - paying_agent – платежный агент
     * - paying_subagent – платежный субагент
     * - attorney – поверенный
     * - commission_agent – комиссионер
     * - another – другой тип агента
     * @param string|null $operationName Наименование операции.
     * Атрибут обязателен, если AgentSign передан в значениях:
     * - bank_paying_agent
     * - bank_paying_subagent
     * @param string[]|null $phones Телефоны платежного агента, в формате +{Ц}.
     * Атрибут обязателен, если в AgentSign передан в значениях:
     * - bank_paying_agent
     * - bank_paying_subagent
     * - paying_agent
     * - paying_subagent
     * @param string[]|null $receiverPhones Телефоны оператора по приему платежей, в формате +{Ц}.
     * Атрибут обязателен, если в AgentSign передан в значениях:
     * - paying_agent
     * - paying_subagent
     * @param string[]|null $transferPhones Телефоны оператора перевода, в формате +{Ц}.
     * Атрибут обязателен, если в AgentSign передан в значениях:
     * - bank_paying_agent
     * - bank_paying_subagent
     * @param string|null $operatorName Наименование оператора перевода.
     * Атрибут обязателен, если в AgentSign передан в значениях:
     * - bank_paying_agent
     * - bank_paying_subagent
     * @param string|null $operatorAddress Адрес оператора перевода.
     * Атрибут обязателен, если в AgentSign передан в значениях:
     * - bank_paying_agent
     * - bank_paying_subagent
     * @param string|null $operatorInn ИНН оператора перевода.
     * Атрибут обязателен, если в AgentSign передан в значениях:
     * - bank_paying_agent
     * - bank_paying_subagent
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
}

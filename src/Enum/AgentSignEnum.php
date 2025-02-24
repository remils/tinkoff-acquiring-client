<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * AgentSignEnum
 */
enum AgentSignEnum: string
{
    case BankPayingAgent = 'bank_paying_agent';
    case BankPayingSubagent = 'bank_paying_subagent';
    case PayingAgent = 'paying_agent';
    case PayingSubagent = 'paying_subagent';
    case Attorney = 'attorney';
    case CommissionAgent = 'commission_agent';
    case Another = 'another';
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

/**
 * Sign of agent
 */
class AgentSign
{
    /** Bank payment agent */
    public const BANK_PAYING_AGENT = 'bank_paying_agent';

    /** Bank payment subagent */
    public const BANK_PAYING_SUBAGENT = 'bank_paying_subagent';

    /** Payment Agent */
    public const PAYING_AGENT = 'paying_agent';

    /** Payment Subagent */
    public const PAYING_SUBAGENT = 'paying_subagent';

    /** Attorney */
    public const ATTORNEY = 'attorney';

    /** Commissioner */
    public const COMMISSION_AGENT = 'commission_agent';

    /** Another type of agent */
    public const ANOTHER = 'another';
}

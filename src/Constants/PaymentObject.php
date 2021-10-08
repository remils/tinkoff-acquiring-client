<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

/**
 * Sign of the subject of the calculation
 */
class PaymentObject
{
    /** Product */
    public const COMMODITY             = 'commodity';

    /** Crossing commodity */
    public const EXCISE                = 'excise';

    /** Work */
    public const JOB                   = 'job';

    /** Service */
    public const SERVICE               = 'service';

    /** Betting a gambling */
    public const GAMBLING_BET          = 'gambling_bet';

    /** Gambling win */
    public const GAMBLING_PRIZE        = 'gambling_prize';

    /** Lottery ticket */
    public const LOTTERY               = 'lottery';

    /** Winning lottery */
    public const LOTTERY_PRIZE         = 'lottery_prize';

    /** Providing Intellectual Activities */
    public const INTELLECTUAL_ACTIVITY = 'intellectual_activity';

    /** Payment */
    public const PAYMENT               = 'payment';

    /** Agent's commission */
    public const AGENT_COMMISSION      = 'agent_commission';

    /** Composite subject of calculation */
    public const COMPOSITE             = 'composite';

    /** Other subject of calculation */
    public const ANOTHER               = 'another';
}

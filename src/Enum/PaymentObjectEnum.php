<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * PaymentObjectEnum
 */
enum PaymentObjectEnum: string
{
    case Commodity = 'commodity';
    case Excise = 'excise';
    case Job = 'job';
    case Service = 'service';
    case GamblingBet = 'gambling_bet';
    case GamblingPrize = 'gambling_prize';
    case Lottery = 'lottery';
    case LotteryPrize = 'lottery_prize';
    case IntellectualActivity = 'intellectual_activity';
    case Payment = 'payment';
    case AgentCommission = 'agent_commission';
    case Composite = 'composite';
    case Another = 'another';
}

<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * PaymentObjectEnum
 */
enum PaymentObjectEnum: string
{
    case COMMODITY = 'commodity';
    case EXCISE = 'excise';
    case JOB = 'job';
    case SERVICE = 'service';
    case GAMBLING_BET = 'gambling_bet';
    case GAMBLING_PRIZE = 'gambling_prize';
    case LOTTERY = 'lottery';
    case LOTTERY_PRIZE = 'lottery_prize';
    case INTELLECTUAL_ACTIVITY = 'intellectual_activity';
    case PAYMENT = 'payment';
    case AGENT_COMMISSION = 'agent_commission';
    case COMPOSITE = 'composite';
    case ANOTHER = 'another';
}

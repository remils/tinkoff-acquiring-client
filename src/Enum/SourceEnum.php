<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

/**
 * SourceEnum
 *
 * Источник платежа
 */
enum SourceEnum: string
{
    case Bnpl = 'BNPL';
    case Cards = 'cards';
    case Installment = 'Installment';
    case MirPay = 'MirPay';
    case QrSbp = 'qrsbp';
    case SberPay = 'SberPay';
    case TinkoffPay = 'TinkoffPay';
    case YandexPay = 'YandexPay';
}

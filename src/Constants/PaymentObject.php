<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

class PaymentObject
{
    const COMMODITY             = 'commodity';             // Товар
    const EXCISE                = 'excise';                // Подакцизный товар
    const JOB                   = 'job';                   // Работа
    const SERVICE               = 'service';               // Услуга
    const GAMBLING_BET          = 'gambling_bet';          // Ставка азартной игры
    const GAMBLING_PRIZE        = 'gambling_prize';        // Выигрыш азартной игры
    const LOTTERY               = 'lottery';               // Лотерейный билет
    const LOTTERY_PRIZE         = 'lottery_prize';         // Выигрыш лотереи
    const INTELLECTUAL_ACTIVITY = 'intellectual_activity'; // Предоставление результатов интеллектуальной деятельности
    const PAYMENT               = 'payment';               // Платеж
    const AGENT_COMMISSION      = 'agent_commission';      // Агентское вознаграждение
    const COMPOSITE             = 'composite';             // Составной предмет расчета
    const ANOTHER               = 'another';               // Иной предмет расчета
}

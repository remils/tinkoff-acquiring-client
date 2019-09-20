<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Constants;

class PaymentObject
{
    const commodity             = 'commodity';             //Товар
    const excise                = 'excise';                //Подакцизный товар
    const job                   = 'job';                   //Работа
    const service               = 'service';               //Услуга
    const gambling_bet          = 'gambling_bet';          //Ставка азартной игры
    const gambling_prize        = 'gambling_prize';        //Выигрыш азартной игры
    const lottery               = 'lottery';               //Лотерейный билет
    const lottery_prize         = 'lottery_prize';         //Выигрыш лотереи
    const intellectual_activity = 'intellectual_activity'; //Предоставление результатов интеллектуальной деятельности
    const payment               = 'payment';               //Платеж
    const agent_commission      = 'agent_commission';      //Агентское вознаграждение
    const composite             = 'composite';             //Составной предмет расчета
    const another               = 'another';               //Иной предмет расчета
}
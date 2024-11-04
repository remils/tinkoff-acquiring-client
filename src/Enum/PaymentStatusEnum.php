<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Enum;

enum PaymentStatusEnum: string
{
    /**
     * Новая сессия операции.
     */
    case New = 'NEW';

    /**
     * Платеж отменен до воспроизведения операции. Конечный статус.
     */
    case Canceled = 'CANCELED';

    /**
     * Произведен переход на страницу операции.
     */
    case FormShowed = 'FORM_SHOWED';

    /**
     * Истек срок жизни операции. Конечный статус.
     */
    case DeadlineExpired = 'DEADLINE_EXPIRED';

    /**
     * Авторизация операции.
     */
    case Authorizing = 'AUTHORIZING';

    /**
     * Операция отклонена. Конечный статус.
     */
    case Rejected = 'REJECTED';

    /**
     * Операция проходит проверку 3D-Secure.
     */
    case SecureChecking = '3DS_CHECKING';

    /**
     * Операция успешна прошла проверку 3D-Secure.
     */
    case SecureChecked = '3DS_CHECKED';

    /**
     * Ошибка авторизации операции.
     */
    case AuthFail = 'AUTH_FAIL';

    /**
     * Операция авторизована, блокировка средств.
     */
    case Authorized = 'AUTHORIZED';

    /**
     * Отмена авторизованной операции.
     */
    case Reversing = 'REVERSING';

    /**
     * Произведен частичный возврат из авторизованной операции.
     */
    case PartialReversed = 'PARTIAL_REVERSED';

    /**
     * Произведен полный возврат из авторизованной операции. Конечный статус.
     */
    case Reversed = 'REVERSED';

    /**
     * Подтверждение авторизованной операции.
     */
    case Confirming = 'CONFIRMING';

    /**
     * Авторизованная операция подтверждена. Списание средств.
     */
    case Confirmed = 'CONFIRMED';

    /**
     * Обработка отмены списания средств.
     */
    case Refunding = 'REFUNDING';

    /**
     * Частичный возврат списанных средств.
     */
    case PartialRefunded = 'PARTIAL_REFUNDED';

    /**
     * Полный возврат списанных средств. Конечный статус.
     */
    case Refunded = 'REFUNDED';

    /**
     * Проверка данных по операции.
     */
    case Checking = 'CHECKING';

    /**
     * Операция на стадии обработки.
     */
    case CreditChecking = 'CREDIT_CHECKING';

    /**
     * Проверка операции прошла успешно.
     */
    case Checked = 'CHECKED';

    /**
     * Операция выполняется.
     */
    case Completing = 'COMPLETING';

    /**
     * Операция успешно выполнена.
     */
    case Completed = 'COMPLETED';

    /**
     * Статус операции не определен.
     */
    case Unknown = 'UNKNOWN';
}

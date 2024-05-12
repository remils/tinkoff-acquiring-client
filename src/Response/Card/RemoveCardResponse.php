<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

/**
 * RemoveCardResponse
 */
class RemoveCardResponse
{
    /**
     * @param string $terminalKey Идентификатор терминала. Выдается Мерчанту Тинькофф Кассой при заведении терминала.
     * @param string $status Статус карты: D – удалена
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string $cardId Идентификатор карты в системе Тинькофф Кассы
     * @param int $cardType Тип карты:
     * - карта списания (0);
     * - карта пополнения(1);
     * - карта пополнения и списания (2).
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $errorCode Код ошибки. «0» в случае успеха
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     */
    public function __construct(
        public readonly string $terminalKey,
        public readonly string $status,
        public readonly string $customerKey,
        public readonly string $cardId,
        public readonly int $cardType,
        public readonly bool $success,
        public readonly string $errorCode,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
    ) {
    }
}

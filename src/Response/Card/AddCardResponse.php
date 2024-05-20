<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

/**
 * AddCardResponse
 */
class AddCardResponse
{
    /**
     * @param string $terminalKey Идентификатор терминала. Выдается Мерчанту Тинькофф Кассой при заведении терминала.
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string $requestKey Идентификатор запроса на привязку карты
     * @param string $paymentUrl Ссылка на страницу привязки карты. На данную страницу необходимо переадресовать клиента
     * для привязки карты.
     * @param int|null $paymentId Идентификатор операции. Не возвращается при CheckType NO
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $errorCode Код ошибки. «0» в случае успеха
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     */
    public function __construct(
        public readonly string $terminalKey,
        public readonly string $customerKey,
        public readonly string $requestKey,
        public readonly string $paymentUrl,
        public readonly bool $success,
        public readonly string $errorCode,
        public readonly ?int $paymentId = null,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
    ) {
    }
}

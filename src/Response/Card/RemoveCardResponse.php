<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Response\Card;

use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardStatusEnum;
use SergeyZatulivetrov\TinkoffAcquiring\Enum\CardTypeEnum;

/**
 * RemoveCardResponse
 *
 * @phpstan-type T array{
 *      TerminalKey: string,
 *      Status: string,
 *      CustomerKey: string,
 *      CardId: string,
 *      CardType: int,
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class RemoveCardResponse
{
    /**
     * @param string $terminalKey Идентификатор терминала. Выдается Мерчанту Тинькофф Кассой при заведении терминала.
     * @param CardStatusEnum $status Статус карты
     * @param string $customerKey Идентификатор клиента в системе Мерчанта
     * @param string $cardId Идентификатор карты в системе Тинькофф Кассы
     * @param CardTypeEnum $cardType Тип карты
     * @param bool $success Успешность прохождения запроса (true/false)
     * @param string $errorCode Код ошибки. «0» в случае успеха
     * @param string|null $message Краткое описание ошибки
     * @param string|null $details Подробное описание ошибки
     */
    public function __construct(
        public readonly string $terminalKey,
        public readonly CardStatusEnum $status,
        public readonly string $customerKey,
        public readonly string $cardId,
        public readonly CardTypeEnum $cardType,
        public readonly bool $success,
        public readonly string $errorCode,
        public readonly ?string $message = null,
        public readonly ?string $details = null,
    ) {
    }

    /**
     * @param T $data
     * @return RemoveCardResponse
     */
    public static function fromArray(array $data): RemoveCardResponse
    {
        return new RemoveCardResponse(
            terminalKey: $data['TerminalKey'],
            status: CardStatusEnum::from($data['Status']),
            customerKey: $data['CustomerKey'],
            cardId: $data['CardId'],
            cardType: CardTypeEnum::from($data['CardType']),
            success: $data['Success'],
            errorCode: $data['ErrorCode'],
            message: $data['Message'] ?? null,
            details: $data['Details'] ?? null,
        );
    }
}

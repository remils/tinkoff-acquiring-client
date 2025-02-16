<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\Init;

use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * InitPayoutRequest
 *
 * Инициализация выплаты
 *
 * @template TSignatureData of array<string,string>
 *
 * @phpstan-type TData array{
 *      TerminalKey: string,
 *      OrderId: string,
 *      CardId: string,
 *      Amount: integer,
 *      DATA: array<string,string|integer|float|boolean>
 * }
 *
 * @implements InitRequestInterface<TData,TSignatureData>
 */
class InitPayoutRequest implements InitRequestInterface
{
    /**
     * @param string $orderId Уникальный номер заказа в системе Мерчанта
     * @param string $cardId Идентификатор карты пополнения привязанной с помощью метода AddCard
     * @param int $amount Сумма в копейках
     * @param array<string,string|integer|float|boolean>|null $data Дополнительные параметры
     */
    public function __construct(
        public readonly string $orderId,
        public readonly int $amount,
        public readonly string $cardId,
        public readonly ?array $data = null,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function build(string $terminalKey, SignatureServiceInterface $signatureService)
    {
        $data = [
            'TerminalKey' => $terminalKey,
            'OrderId' => $this->orderId,
            'CardId' => $this->cardId,
            'Amount' => $this->amount,
        ];

        if (null !== $this->data) {
            $data['DATA'] = $this->data;
        }

        return $signatureService->signedRequest($data);
    }
}

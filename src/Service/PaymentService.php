<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Service;

use SergeyZatulivetrov\TinkoffAcquiring\Client\Contract\ClientInterface;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\InitRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\PaymentRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Request\Payment\StateRequest;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Payment\InitResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Payment\PaymentResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Response\Payment\StateResponse;
use SergeyZatulivetrov\TinkoffAcquiring\Service\Signature\SignatureServiceInterface;

/**
 * PaymentService
 *
 * @phpstan-type TInit array{
 *      TerminalKey: string,
 *      Amount: int,
 *      OrderId: string,
 *      Success: bool,
 *      Status: string,
 *      PaymentId: string,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 *
 * @phpstan-type TPayment array{
 *      TerminalKey: string,
 *      OrderId: string,
 *      PaymentId: string,
 *      Status: string,
 *      Success: bool,
 *      ErrorCode: string,
 *      Message: string|null,
 *      Details: string|null
 * }
 *
 * @phpstan-type TState array{
 *      TerminalKey: string,
 *      OrderId: string,
 *      PaymentId: string,
 *      Status: string,
 *      Success: bool,
 *      ErrorCode: string,
 *      Amount: int|null,
 *      Message: string|null,
 *      Details: string|null
 * }
 */
class PaymentService
{
    public function __construct(
        protected readonly string $terminalKey,
        protected readonly SignatureServiceInterface $signatureService,
        protected readonly ClientInterface $client,
    ) {
    }

    /**
     * Инициирует выплату
     * @param InitRequest $request
     * @return InitResponse
     */
    public function init(InitRequest $request): InitResponse
    {
        $data = [
            'TerminalKey' => $this->terminalKey,
            'OrderId' => $request->orderId,
            'CardId' => $request->cardId,
            'Amount' => $request->amount,
        ];

        if (null !== $request->data) {
            $data['DATA'] = $request->data;
        }

        /**
         * @var TInit $response
         */
        $response = $this->client->execute(
            action: 'Init',
            data: $this->signatureService->signedRequest($data),
        );

        return new InitResponse(
            terminalKey: $response['TerminalKey'],
            amount: $response['Amount'],
            orderId: $response['OrderId'],
            success: $response['Success'],
            status: $response['Status'],
            paymentId: $response['PaymentId'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null
        );
    }

    /**
     * Производит пополнение карты
     * @param PaymentRequest $request
     * @return PaymentResponse
     */
    public function payment(PaymentRequest $request): PaymentResponse
    {
        $data = [
            'TerminalKey' => $this->terminalKey,
            'PaymentId' => $request->paymentId,
        ];

        /**
         * @var TPayment $response
         */
        $response = $this->client->execute(
            action: 'Payment',
            data: $this->signatureService->signedRequest($data),
        );

        return new PaymentResponse(
            terminalKey: $response['TerminalKey'],
            orderId: $response['OrderId'],
            paymentId: $response['PaymentId'],
            status: $response['Status'],
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null
        );
    }

    /**
     * Возвращает текущий статус выплаты
     * @param StateRequest $request
     * @return StateResponse
     */
    public function state(StateRequest $request): StateResponse
    {
        $data = [
            'TerminalKey' => $this->terminalKey,
            'PaymentId' => $request->paymentId,
        ];

        /**
         * @var TState $response
         */
        $response = $this->client->execute(
            action: 'GetState',
            data: $this->signatureService->signedRequest($data),
        );

        return new StateResponse(
            terminalKey: $response['TerminalKey'],
            orderId: $response['OrderId'],
            paymentId: $response['PaymentId'],
            status: $response['Status'],
            success: $response['Success'],
            errorCode: $response['ErrorCode'],
            amount: $response['Amount'] ?? null,
            message: $response['Message'] ?? null,
            details: $response['Details'] ?? null
        );
    }
}

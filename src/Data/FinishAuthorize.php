<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Data;

use OpenSSLAsymmetricKey;
use OpenSSLCertificate;

/**
 * Confirms the payment of the transfer of details and write-off / blocking funds
 *
 * @url https://www.tinkoff.ru/kassa/develop/api/payments/finishAuthorize-request/
 *
 * @property string      $TerminalKey          Terminal ID. It is issued to the Seller by the Bank at
 *                                             the Terminal Institution
 * @property string      $CardData             Encrypted card data
 * @property string      $EncryptedPaymentData Card data
 * @property int         $Amount               Amount in kopecks
 * @property array       $DATA                 Advanced payment options in "Key" format: "Value" (no more than 20 pairs)
 * @property string      $InfoEmail            Email to send payment information
 * @property string      $IP                   IP address client
 * @property int         $PaymentId            A unique transaction identifier in the bank system obtained in response
 *                                             to the initiating method
 * @property string      $Phone                Phone Client
 * @property bool        $SendEmail            True - Send the client information on payment of payment,
 *                                             false - Do not send
 * @property string      $Route                Method of payment
 * @property string      $Source               Source of payment
 */
class FinishAuthorize extends AbstractDataWithToken
{
    /**
     * Encryption data cards
     *
     * @param OpenSSLAsymmetricKey|OpenSSLCertificate|array|string $public_key Public encryption key
     * @param CardData                                             $cardData   Card data
     */
    public function encodeCardData($publicKey, CardData $cardData): void
    {
        $data = [];

        foreach ($cardData->toArray() as $key => $value) {
            $data[] = "{$key}={$value}";
        }

        openssl_public_encrypt(join(';', $data), $encrypted, openssl_get_publickey($publicKey));

        $this->CardData = base64_encode($encrypted);
    }
}

<?php

namespace Jetimob\Juno\Api\Transference;

use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Api\AbstractApi;
use Jetimob\Juno\Entity\BankAccount;
use Jetimob\Juno\Entity\PixBankAccount;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Transferencias
 */
class TransferenceApi extends AbstractApi
{
    public const P2P_TRANSFER_REQUEST = 'P2P';
    public const DEFAULT_BANK_ACCOUNT_TRANSFER_REQUEST = 'DEFAULT_BANK_ACCOUNT';
    public const BANK_ACCOUNT_TRANSFER_REQUEST = 'BANK_ACCOUNT';
    public const PIX_TRANSFER_REQUEST = 'PIX';

    /**
     * Através deste serviço é possível efetuar transferências para a Conta Bancária padrão do cliente, para Contas
     * Bancárias de terceiros ou para Contas Digitais Juno.
     *
     * @param string $type
     * @param string $name
     * @param string $document
     * @param float $amount
     * @param BankAccount|PixBankAccount $bankAccount
     * @return TransferenceResponse
     * @link https://dev.juno.com.br/api/v2#operation/requestTransfer
     */
    public function transfer(
        string $type,
        string $name,
        string $document,
        float $amount,
        $bankAccount
    ): TransferenceResponse {
        return $this->mappedPost('transfers', TransferenceResponse::class, [
            RequestOptions::JSON => [
                'type' => $type,
                'name' => $name,
                'document' => $document,
                'amount' => $amount,
                'bankAccount' => $bankAccount,
            ],
        ]);
    }

    /**
     * @param float $amount
     * @link https://dev.juno.com.br/api/v2#operation/requestTransfer
     * @return TransferenceResponse
     */
    public function defaultBankAccount(float $amount): TransferenceResponse
    {
        return $this->mappedPost('transfers', TransferenceResponse::class, [
            RequestOptions::JSON => [
                'type' => self::DEFAULT_BANK_ACCOUNT_TRANSFER_REQUEST,
                'amount' => $amount,
            ],
        ]);
    }

    /**
     * @param string $name
     * @param string $document
     * @param float $amount
     * @param BankAccount $bankAccount
     * @link https://dev.juno.com.br/api/v2#operation/requestTransfer
     * @return TransferenceResponse
     */
    public function bankAccount(
        string $name,
        string $document,
        float $amount,
        BankAccount $bankAccount
    ): TransferenceResponse {
        return $this->transfer(
            self::BANK_ACCOUNT_TRANSFER_REQUEST,
            $name,
            $document,
            $amount,
            $bankAccount
        );
    }

    /**
     * @param string $name
     * @param string $document
     * @param float $amount
     * @param PixBankAccount $bankAccount
     * @link https://dev.juno.com.br/api/v2#operation/requestTransfer
     * @return TransferenceResponse
     */
    public function pix(
        string $name,
        string $document,
        float $amount,
        PixBankAccount $bankAccount
    ): TransferenceResponse {
        return $this->transfer(
            self::PIX_TRANSFER_REQUEST,
            $name,
            $document,
            $amount,
            $bankAccount
        );
    }

    /**
     * @param string $name
     * @param string $document
     * @param float $amount
     * @param string $accountNumber
     * @link https://dev.juno.com.br/api/v2#operation/requestTransfer
     * @return TransferenceResponse
     */
    public function p2p(
        string $name,
        string $document,
        float $amount,
        string $accountNumber
    ): TransferenceResponse {
        return $this->mappedPost('transfers', TransferenceResponse::class, [
            RequestOptions::JSON => [
                'type' => self::P2P_TRANSFER_REQUEST,
                'name' => $name,
                'document' => $document,
                'amount' => $amount,
                'bankAccount' => [
                    'accountNumber' => $accountNumber,
                ],
            ],
        ]);
    }
}

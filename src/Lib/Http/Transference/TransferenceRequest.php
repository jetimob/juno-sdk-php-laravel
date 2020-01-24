<?php

namespace Jetimob\Juno\Lib\Http\Transference;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;
use Jetimob\Juno\Lib\Model\BankAccount;

/**
 * Class TransferenceRequest
 * @package Jetimob\Juno\Lib\Http\Transference
 * @see https://dev.juno.com.br/api/v2#operation/requestTransfer
 */
class TransferenceRequest extends Request
{
    public const BANK_ACCOUNT_TRANSFER_REQUEST = 'BANK_ACCOUNT';

    public string $type = self::BANK_ACCOUNT_TRANSFER_REQUEST;

    public string $name;

    public string $document;

    public float $amount;

    public BankAccount $bankAccount;

    protected array $bodySchema = [
        'type',
        'name',
        'document',
        'amount',
        'bankAccount',
    ];

    /**
     * @inheritDoc
     */
    protected function method(): string
    {
        return Method::POST;
    }

    /**
     * @inheritDoc
     */
    protected function urn(): string
    {
        return 'transfers';
    }
}

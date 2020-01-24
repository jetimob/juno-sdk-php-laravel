<?php

namespace Jetimob\Juno\Lib\Http\Account;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;
use Jetimob\Juno\Lib\Model\Address;
use Jetimob\Juno\Lib\Model\BankAccount;
use Jetimob\Juno\Lib\Model\LegalRepresentative;

/**
 * Class AccountCreationRequest
 * @package Jetimob\Juno\Lib\Http\Account
 * @see https://dev.juno.com.br/api/v2#operation/createDigitalAccount
 */
class AccountCreationRequest extends Request
{
    /**
     * @var string PAYMENT_ACCOUNT_TYPE
     * - A fully functional payment digital account
     * - All features available
     */
    private const PAYMENT_ACCOUNT_TYPE = 'PAYMENT';
    /**
     * @var string RECEIVING_ACCOUNT_TYPE
     * - A specific digital account only used for receiving
     * - Just receiving features available
     */
    private const RECEIVING_ACCOUNT_TYPE = 'RECEIVING';

    /** @var string $companyType MANDATORY FOR COMPANIES */
    public string $companyType;

    /** @var string $name [0 .. 80] chars */
    public string $name;

    /** @var string CPF 11 chars || CNPJ 14 chars */
    public string $document;

    /** @var string $email [0 .. 80] chars */
    public string $email;

    /** @var string $phone [10 .. 16] chars */
    public string $phone;

    /** @var int $businessArea business area id */
    public int $businessArea;

    /** @var string $tradingName [0 .. 80] chars */
    public string $tradingName;

    /** @var string $birthDate MANDATORY FOR INDIVIDUALS <date> YYYY-MM-DD */
    public string $birthDate;

    public Address $address;

    public BankAccount $bankAccount;

    /** @var LegalRepresentative $legalRepresentative MANDATORY FOR COMPANIES */
    public LegalRepresentative $legalRepresentative;

    public string $type = 'RECEIVING';

    /** @var string $linesOfBusiness [0 .. 100 chars] free description */
    public string $linesOfBusiness;

    /** @var string $businessUrl [0 .. 100 chars] for RECEIVING ACCOUNT ONLY */
    public string $businessUrl;

    // the bool default values are specified in Juno's documentation
    // all bool options defined below are marked as ADVANCED and should require additional permissions

    public bool $emailOptOut = false;

    public bool $autoApprove = false;

    public bool $autoTransfer = false;

    /** @var array $bodySchema defines the body schema common for both types of account */
    protected array $bodySchema = [
        'companyType',
        'name',
        'document',
        'email',
        'phone',
        'businessArea',
        'tradingName',
        'birthDate',
        'address',
        'bankAccount',
        'legalRepresentative',
        'type',
    ];

    public function getBodySchema(): array
    {
        if ($this->type === self::PAYMENT_ACCOUNT_TYPE) {
            return array_merge($this->bodySchema, ['linesOfBusiness']);
        }

        return array_merge($this->bodySchema, ['businessUrl']);
    }

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
        return 'digital-accounts';
    }
}

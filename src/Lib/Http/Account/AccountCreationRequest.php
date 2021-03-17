<?php

namespace App;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Model\Address;
use Jetimob\Juno\Lib\Model\BankAccount;
use Jetimob\Juno\Lib\Model\LegalRepresentative;
use Jetimob\Juno\Lib\Http\Account\AccountRequest;

/**
 * Class AccountCreationRequest
 * @package Jetimob\Juno\Lib\Http\Account
 * @see https://dev.juno.com.br/api/v2#operation/createDigitalAccount
 */
class AccountCreationRequest extends AccountRequest
{
    /**
     * @var string PAYMENT_ACCOUNT_TYPE
     * - A fully functional payment digital account
     * - All features available
     */
    public const PAYMENT_ACCOUNT_TYPE = 'PAYMENT';
    /**
     * @var string RECEIVING_ACCOUNT_TYPE
     * - A specific digital account only used for receiving
     * - Just receiving features available
     */
    public const RECEIVING_ACCOUNT_TYPE = 'RECEIVING';

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

    public string $monthlyIncomeOrRevenue;

    public string $cnae;

    public string $establishmentDate;

    public Address $address;

    public BankAccount $bankAccount;

    /** @var LegalRepresentative $legalRepresentative MANDATORY FOR COMPANIES */
    public LegalRepresentative $legalRepresentative;

    public string $type = self::PAYMENT_ACCOUNT_TYPE;

    /** @var string $linesOfBusiness [0 .. 100 chars] free description */
    public string $linesOfBusiness;

    /** @var string $businessUrl [0 .. 100 chars] for RECEIVING ACCOUNT ONLY */
    public string $businessUrl;

    // the bool default values are specified in Juno's documentation
    // all bool options defined below are marked as ADVANCED and should require additional permissions

    // any value different than false will send the param with the request. Use it ONLY if your is authorized to do so.

    /** @var bool $emailOptOut enables transparent checkout */
    public bool $emailOptOut;

    public bool $autoApprove;

    public bool $autoTransfer;

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
        'emailOptOut',
        'autoApprove',
        'autoTransfer',
        'monthlyIncomeOrRevenue',
        'establishmentDate',
        'cnae'
    ];

    public function getBodySchema(): array
    {
        $schema = [...$this->bodySchema];
        $setIfModified = function ($advancedOpt) use (&$schema) {
            if (isset($this->{$advancedOpt})) {
                $schema[] = $advancedOpt;
            }
        };

        $setIfModified('emailOptOut');
        $setIfModified('autoApprove');
        $setIfModified('autoTransfer');

        if ($this->type === self::PAYMENT_ACCOUNT_TYPE) {
            return [...$this->bodySchema, 'linesOfBusiness'];
        }

        return [...$this->bodySchema, 'businessUrl'];
    }

    /**
     * @inheritDoc
     */
    protected function method(): string
    {
        return Method::POST;
    }
}

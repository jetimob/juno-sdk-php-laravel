<?php

namespace Jetimob\Juno\Lib\Http\Account;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Model\Address;
use Jetimob\Juno\Lib\Model\BankAccount;
use Jetimob\Juno\Lib\Model\LegalRepresentative;

/**
 * Class AccountUpdateRequest
 * @package Jetimob\Juno\Lib\Http\Account
 * @see https://dev.juno.com.br/api/v2#operation/updateDigitalAccount
 */
class AccountUpdateRequest extends AccountRequest
{
    /** @var string|null $companyType MANDATORY FOR COMPANIES */
    public ?string $companyType;

    /** @var string|null $name [0 .. 80] chars */
    public ?string $name;

    /** @var string|null $birthDate MANDATORY FOR INDIVIDUALS <date> YYYY-MM-DD */
    public ?string $birthDate;

    /** @var string $linesOfBusiness [0 .. 100 chars] free description */
    public string $linesOfBusiness;

    /** @var string|null $email [0 .. 80] chars */
    public ?string $email;

    /** @var string|null $phone [10 .. 16] chars */
    public ?string $phone;

    /** @var int|null $businessArea business area id */
    public ?int $businessArea;

    /** @var string|null $tradingName [0 .. 80] chars */
    public ?string $tradingName;

    public ?Address $address;

    public ?BankAccount $bankAccount;

    public ?LegalRepresentative $legalRepresentative;

    protected array $bodySchema = [
        'companyType',
        'name',
        'birthDate',
        'linesOfBusiness',
        'email',
        'phone',
        'businessArea',
        'tradingName',
        'address',
        'bankAccount',
        'legalRepresentative',
    ];

    /**
     * @inheritDoc
     */
    protected function method(): string
    {
        return Method::PATCH;
    }
}

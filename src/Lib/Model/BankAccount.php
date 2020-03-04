<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class BankAccount
{
    use Serializable;

    public const CHECKING_ACCOUNT_TYPE = 'CHECKING';
    public const SAVINGS_ACCOUNT_TYPE = 'SAVINGS';

    public string $bankNumber;

    public string $agencyNumber;

    public string $accountNumber;

    public string $accountComplementNumber;

    public string $accountType;

    public ?AccountHolder $accountHolder = null;
}

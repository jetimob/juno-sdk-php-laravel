<?php

namespace Jetimob\Juno\Lib\Model\Notification;

use Jetimob\Juno\Lib\Traits\Serializable;

class BankAccount
{
    use Serializable;

    public string $bankNumber;

    public string $agencyNumber;

    public string $accountNumber;

    /** @var string $accountType Enum: CHECKING | SAVINGS */
    public string $accountType;

}
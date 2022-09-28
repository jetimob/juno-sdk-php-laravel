<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class BankAccount
{
    use Serializable;

    protected string $bankNumber;

    protected string $agencyNumber;

    protected string $accountNumber;

    /** @var string $accountType Enum: CHECKING | SAVINGS */
    protected string $accountType;

    /**
     * @return string
     */
    public function getBankNumber(): string
    {
        return $this->bankNumber;
    }

    /**
     * @return string
     */
    public function getAgencyNumber(): string
    {
        return $this->agencyNumber;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->accountType;
    }
}

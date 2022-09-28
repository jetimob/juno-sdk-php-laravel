<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class Recipient
{
    use Serializable;

    protected string $name;
    protected string $document;
    protected BankAccount $bankAccount;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * @return BankAccount
     */
    public function getBankAccount(): BankAccount
    {
        return $this->bankAccount;
    }
}

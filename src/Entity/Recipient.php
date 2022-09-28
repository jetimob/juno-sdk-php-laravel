<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class Recipient
{
    use Serializable;

    protected string $name;
    protected string $document;
    protected PixBankAccount $bankAccount;

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
     * @return PixBankAccount
     */
    public function getBankAccount(): PixBankAccount
    {
        return $this->bankAccount;
    }
}

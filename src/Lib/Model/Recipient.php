<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class Recipient
{
    use Serializable;

    public string $name;

    public string $document;

    public BankAccount $bankAccount;
}

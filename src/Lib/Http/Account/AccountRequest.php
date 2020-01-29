<?php

namespace Jetimob\Juno\Lib\Http\Account;

use Jetimob\Juno\Lib\Http\Request;

abstract class AccountRequest extends Request
{
    /**
     * @inheritDoc
     */
    public function urn(): string
    {
        return 'digital-accounts';
    }
}

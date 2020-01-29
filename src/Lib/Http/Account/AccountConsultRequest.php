<?php

namespace Jetimob\Juno\Lib\Http\Account;

use Jetimob\Juno\Lib\Http\Method;

/**
 * Class AccountConsultRequest
 * @package Jetimob\Juno\Lib\Http\Account
 * @see https://dev.juno.com.br/api/v2#operation/findDigitalAccount
 */
class AccountConsultRequest extends AccountRequest
{
    /**
     * @inheritDoc
     */
    protected function method(): string
    {
        return Method::GET;
    }
}

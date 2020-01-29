<?php

namespace Jetimob\Juno\Lib\Http\Account;

use Jetimob\Juno\Lib\Http\Response;

/**
 * Class AccountUpdateResponse
 * @package Jetimob\Juno\Lib\Http\Account
 * @see https://dev.juno.com.br/api/v2#operation/updateDigitalAccount
 */
class AccountUpdateResponse extends Response
{
    public string $id;
}

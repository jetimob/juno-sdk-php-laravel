<?php

namespace Jetimob\Juno\Lib\Http\Account;

use Jetimob\Juno\Lib\Http\Response;

/**
 * Class AccountConsultResponse
 * @package Jetimob\Juno\Lib\Http\Account
 * @see https://dev.juno.com.br/api/v2#operation/findDigitalAccount
 */
class AccountConsultResponse extends Response
{
    public string $id;

    public string $type;
}

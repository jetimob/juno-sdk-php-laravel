<?php

namespace Jetimob\Juno\Lib\Http\Balance;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

class BalanceConsultRequest extends Request
{
    protected function method(): string
    {
        return Method::GET;
    }

    protected function urn(): string
    {
        return 'balance';
    }
}

<?php

namespace Jetimob\Juno\Lib\Http\Balance;

use Jetimob\Juno\Lib\Http\Response;

class BalanceConsultResponse extends Response
{
    public float $balance;

    public float $withheldBalance;

    public float $transferableBalance;
}

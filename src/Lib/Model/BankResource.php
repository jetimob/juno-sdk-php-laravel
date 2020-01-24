<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class BankResource
{
    use Serializable;

    public string $number;

    public string $name;
}

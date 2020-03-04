<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class AccountHolder
{
    use Serializable;

    public string $name;

    /** @var string $document <CPF(len=11)|CNPJ(len=14)> */
    public string $document;
}

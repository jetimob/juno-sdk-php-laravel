<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class Address
{
    use Serializable;

    public string $street;

    public string $number;

    /** @var string $complement optional */
    public string $complement;

    /** @var string $neighborhood optional */
    public string $neighborhood;

    public string $city;

    public string $state;

    /** @var string $postCode 8 chars */
    public string $postCode;
}

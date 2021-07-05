<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class BankResource
{
    use Serializable;

    protected string $number;
    protected string $name;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}

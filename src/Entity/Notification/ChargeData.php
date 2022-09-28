<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class ChargeData
{
    use Serializable;
    use EntityBaseTrait;

    protected ChargeAttributes $attributes;
    protected string $timestamp;

    public function getAttributes(): ChargeAttributes
    {
        return $this->attributes;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }
}

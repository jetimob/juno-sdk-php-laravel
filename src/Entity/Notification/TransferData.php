<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class TransferData
{
    use Serializable;
    use EntityBaseTrait;

    protected TransferAttributes $attributes;

    /**
     * @return TransferAttributes
     */
    public function getAttributes(): TransferAttributes
    {
        return $this->attributes;
    }
}

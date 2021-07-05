<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class PaymentData
{
    use Serializable;
    use EntityBaseTrait;

    protected PaymentAttributes $attributes;

    /**
     * @return PaymentAttributes
     */
    public function getAttributes(): PaymentAttributes
    {
        return $this->attributes;
    }
}

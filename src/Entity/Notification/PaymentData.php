<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class PaymentData
{
    use Serializable;
    use EntityBaseTrait;

    public const BANK_PAID_BACK = 'BANK_PAID_BACK';
    public const CONFIRMED = 'CONFIRMED';
    public const PARTIALLY_REFUNDED = 'PARTIALLY_REFUNDED';
    public const CUSTOMER_PAID_BACK = 'CUSTOMER_PAID_BACK';
    public const DECLINED = 'DECLINED';
    public const FAILED = 'FAILED';
    public const NOT_AUTHORIZED = 'NOT_AUTHORIZED';

    protected PaymentAttributes $attributes;

    /**
     * @return PaymentAttributes
     */
    public function getAttributes(): PaymentAttributes
    {
        return $this->attributes;
    }
}

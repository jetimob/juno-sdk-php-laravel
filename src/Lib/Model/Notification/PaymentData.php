<?php

namespace Jetimob\Juno\Lib\Model\Notification;

use Jetimob\Juno\Lib\Traits\Serializable;

class PaymentData
{
    use Serializable;
    use EntityBaseTrait;

    public PaymentAttributes $attributes;
}
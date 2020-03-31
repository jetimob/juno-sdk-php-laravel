<?php

namespace Jetimob\Juno\Lib\Model\Notification;

use Jetimob\Juno\Lib\Traits\Serializable;

class PaymentAttributes
{
    use Serializable;

    public string $digitalAccountId;

    public string $createdOn;

    public string $date;

    public string $releaseDate;

    public string $amount;

    public string $fee;

    public string $status;

    public string $type;

    public string $paybackDate;

    public string $paybackAmount;

    public Charge $charge;
}
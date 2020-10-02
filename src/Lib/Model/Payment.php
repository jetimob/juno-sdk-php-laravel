<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class Payment
{
    use Serializable;

    public string $id;

    public string $chargeId;

    public string $date;

    public ?string $releaseDate;

    public float $amount;

    public float $fee;

    public string $type;

    public string $status;

    public ?string $transactionId;

    public ?string $creditCardId;
}

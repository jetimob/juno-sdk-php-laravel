<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class ChargeResource
{
    use Serializable;

    public string $id;

    public int $code;

    public string $reference;

    public string $dueDate;

    public string $link;

    public string $checkoutUrl;

    public string $installmentLink;

    public string $payNumber;

    public float $amount;

    public BilletDetails $billetDetails;
}

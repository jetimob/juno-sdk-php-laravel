<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class Split
{
    use Serializable;

    /** @var string|null $recipientToken defines the recipient of the split */
    public ?string $recipientToken;

    /** @var float|null $amount defines the fixed value that the account will receive */
    public ?float $amount;

    /** @var float|null $percentage defines the percentage of the value that the account will receive */
    public ?float $percentage;

    /** @var bool|null $amountReminder indicates who receives the remaining amount in the case of a division of the
     * total transaction amount */
    public ?bool $amountReminder;

    /** @var bool|null $chargeFee indicates whether only one recipient will be taxed or if the fees will be split
     * proportionally between all recipients */
    public ?bool $chargeFee;
}

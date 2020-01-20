<?php

namespace Jetimob\Juno\Lib\Model;

class Split
{
    /** @var string|null $recipientToken defines the recipient of the split */
    private ?string $recipientToken;

    /** @var int|null $amount defines the fixed value that the account will receive */
    private ?int $amount;

    /** @var float|null $percentage defines the percentage of the value that the account will receive */
    private ?float $percentage;

    /** @var bool|null $amountReminder indicates who receives the remaining amount in the case of a division of the
     * total transaction amount */
    private ?bool $amountReminder;

    /** @var bool|null $chargeFee indicates whether only one recipient will be taxed or if the fees will be split
     * proportionally between all recipients */
    private ?bool $chargeFee;
}

<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class Charge
{
    use Serializable;

    /** @var string $description billing description */
    public string $description;

    /** @var array|null $references list of references attached to a generated billing. The amount of items should be
     * equal to the number of portions */
    public ?array $references;

    /** @var float|null $totalAmount total transaction amount */
    public ?float $totalAmount;

    /** @var float|null $amount total portion amount*/
    public ?float $amount;

    /** @var string|null $dueDate expiration date */
    public ?string $dueDate;

    /** @var int|null $installments number of portions */
    public ?int $installments;

    /** @var int|null $maxOverdueDays number of days allowed for payment after expiration */
    public ?int $maxOverdueDays;

    /** @var float|null $fine monthly interest. The amount entered is divided by the number of days to charge daily
     * interest */
    public ?float $fine;

    /** @var float|null $interest fine */
    public ?float $interest;

    /** @var int|null discount amount >= 0 */
    public ?int $discountAmount;

    /** @var int|null $discountDays number of discount days */
    public ?int $discountDays;

    /** @var array|null $paymentTypes array of allowed payment methods */
    public ?array $paymentTypes;

    /** @var Split[]|null array of splits */
    public ?array $split;
}

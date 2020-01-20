<?php

namespace Jetimob\Juno\Lib\Model;

class Charge
{
    /** @var string $description billing description */
    private string $description;

    /** @var array|null $references list of references attached to a generated billing. The amount of items should be
     * equal to the number of portions */
    private ?array $references;

    /** @var float|null $totalAmount total transaction amount */
    private ?float $totalAmount;

    /** @var float|null $amount total portion amount*/
    private ?float $amount;

    /** @var string|null $dueDate expiration date */
    private ?string $dueDate;

    /** @var int|null $installments number of portions */
    private ?int $installments;

    /** @var int|null $maxOverdueDays number of days allowed for payment after expiration */
    private ?int $maxOverdueDays;

    /** @var int|null $fine monthly interest. The amount entered is divided by the number of days to charge daily
     * interest */
    private ?int $fine;

    /** @var int|null $interest fine */
    private ?int $interest;

    /** @var int|null discount amount >= 0 */
    private ?int $discountAmount;

    /** @var int|null $discountDays number of discount days */
    private ?int $discountDays;

    /** @var array|null $paymentTypes array of allowed payment methods */
    private ?array $paymentTypes;

    /** @var Split[]|null array of splits */
    private ?array $split;
}

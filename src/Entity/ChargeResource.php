<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class ChargeResource
{
    use Serializable;

    /** @var string $id <ObjectId> */
    protected string $id;

    /** @var int $code <int64> */
    protected int $code;

    protected string $reference;

    /** @var string $dueDate <date-time> */
    protected string $dueDate;

    protected string $link;

    protected string $checkoutUrl;

    protected string $installmentLink;

    protected string $payNumber;

    protected float $amount;

    /** @var string $status Enum: "ACTIVE", "CANCELLED", "MANUAL_RECONCILIATION", "FAILED" or "PAID"
     */
    protected string $status;

    protected BilletDetails $billetDetails;

    /** @var Payment[] $payments */
    protected array $payments;

    protected Pix $pix;

    public function paymentsItemType(): string
    {
        return Payment::class;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl(): string
    {
        return $this->checkoutUrl;
    }

    /**
     * @return string
     */
    public function getInstallmentLink(): string
    {
        return $this->installmentLink;
    }

    /**
     * @return string
     */
    public function getPayNumber(): string
    {
        return $this->payNumber;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return BilletDetails
     */
    public function getBilletDetails(): BilletDetails
    {
        return $this->billetDetails;
    }

    /**
     * @return Payment[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @return Pix
     */
    public function getPix(): Pix
    {
        return $this->pix;
    }
}

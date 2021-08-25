<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class ChargeAttributes
{
    use Serializable;

    protected string $amount;
    protected string $code;
    protected string $digitalAccountId;
    protected string $dueData;
    protected string $reference;

    /** @var string $status Enum: "ACTIVE", "CANCELLED", "MANUAL_RECONCILIATION", "FAILED" or "PAID"
     */
    protected string $status;

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getDigitalAccountId(): string
    {
        return $this->digitalAccountId;
    }

    /**
     * @return string
     */
    public function getDueData(): string
    {
        return $this->dueData;
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
    public function getStatus(): string
    {
        return $this->status;
    }
}

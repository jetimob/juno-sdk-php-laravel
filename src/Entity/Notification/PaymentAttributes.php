<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

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
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

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
    public function getFee(): string
    {
        return $this->fee;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPaybackDate(): string
    {
        return $this->paybackDate;
    }

    /**
     * @return string
     */
    public function getPaybackAmount(): string
    {
        return $this->paybackAmount;
    }

    /**
     * @return Charge
     */
    public function getCharge(): Charge
    {
        return $this->charge;
    }
}

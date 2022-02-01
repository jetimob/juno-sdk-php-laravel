<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class Charge
{
    use Serializable;

    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_CANCELLED = 'CANCELLED';
    public const STATUS_MANUAL_RECONCILIATION = 'MANUAL_RECONCILIATION';
    public const STATUS_FAILED = 'FAILED';
    public const STATUS_PAID = 'PAID';

    protected string $id;
    protected string $code;
    protected string $dueDate;
    protected string $amount;
    protected string $status;
    protected Payer $payer;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
    public function getDueDate(): string
    {
        return $this->dueDate;
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return Payer
     */
    public function getPayer(): Payer
    {
        return $this->payer;
    }
}

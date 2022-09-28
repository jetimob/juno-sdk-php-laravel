<?php

namespace Jetimob\Juno\Entity;

trait SubscriptionBase
{
    /** @var string $id Id da assinatura criada. */
    protected string $id;

    /** @var string $createdOn <date-type> Data de criação da assinatura. */
    protected string $createdOn;

    /** @var string $dueDay Data de vencimento da assinatura. */
    protected string $dueDay;

    /** @var string $status Enum: "ACTIVE", "INACTIVE", "CANCELED", "COMPLETED". Status atual da assinatura. */
    protected string $status;

    /** @var string $startsOn <date> Data início da assinatura. */
    protected string $startsOn;

    /** @var string $nextBillingDate <date> Data da próxima cobrança. */
    protected string $nextBillingDate;

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
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    /**
     * @return string
     */
    public function getDueDay(): string
    {
        return $this->dueDay;
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
    public function getStartsOn(): string
    {
        return $this->startsOn;
    }

    /**
     * @return string
     */
    public function getNextBillingDate(): string
    {
        return $this->nextBillingDate;
    }
}

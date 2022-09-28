<?php

namespace Jetimob\Juno\Entity;

trait PlanBase
{
    /** @var string $id Identificação do plano criado. */
    protected string $id;

    /** @var string $createdOn <date-time> Data de criação do plano. */
    protected string $createdOn;

    /** @var string $name Nome do plano */
    protected string $name;

    /** @var string $frequency Frequência do plano. Frequencia suportada hoje MONTHLY. */
    protected string $frequency;

    /** @var string $status Enum: "ACTIVE", "INACTIVE". Status atual do plano. */
    protected string $status;

    /** @var float $amount */
    protected float $amount;

    /**
     * @return string Identificação do plano criado.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string <date-time> Data de criação do plano.
     */
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    /**
     * @return string Nome do plano
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string Frequência do plano. Frequencia suportada hoje MONTHLY.
     */
    public function getFrequency(): string
    {
        return $this->frequency;
    }

    /**
     * @return string Enum: "ACTIVE", "INACTIVE". Status atual do plano.
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}

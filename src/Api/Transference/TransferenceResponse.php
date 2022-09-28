<?php

namespace Jetimob\Juno\Api\Transference;

use Jetimob\Juno\Api\JunoResponse;
use Jetimob\Juno\Entity\Recipient;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Transferencias
 */
class TransferenceResponse extends JunoResponse
{
    protected string $id;
    protected string $digitalAccountId;
    /** @var string $creationDate yyyy-MM-dd HH:mm:ss */
    protected string $creationDate;
    /** @var string|null $transferDate yyyy-MM-dd HH:mm:ss */
    protected ?string $transferDate = null;
    protected float $amount;
    protected string $status;
    protected ?Recipient $recipient = null;

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
    public function getDigitalAccountId(): string
    {
        return $this->digitalAccountId;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    /**
     * @return string|null
     */
    public function getTransferDate(): ?string
    {
        return $this->transferDate;
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
     * @return Recipient|null
     */
    public function getRecipient(): ?Recipient
    {
        return $this->recipient;
    }
}

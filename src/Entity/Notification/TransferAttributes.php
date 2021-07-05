<?php

namespace Jetimob\Juno\Entity\Notification;

use Jetimob\Http\Traits\Serializable;

class TransferAttributes
{
    use Serializable;

    public string $digitalAccountId;
    public string $creationDate;
    public ?string $transferDate = null;
    public string $amount;
    public string $status;
    public Recipient $recipient;

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
     * @return Recipient
     */
    public function getRecipient(): Recipient
    {
        return $this->recipient;
    }
}

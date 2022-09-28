<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class WebhookEventType
{
    use Serializable;

    public const DOCUMENT_STATUS_CHANGED = "DOCUMENT_STATUS_CHANGED";
    public const DIGITAL_ACCOUNT_STATUS_CHANGED = "DIGITAL_ACCOUNT_STATUS_CHANGED";
    public const TRANSFER_STATUS_CHANGED = "TRANSFER_STATUS_CHANGED";
    public const P2P_TRANSFER_STATUS_CHANGED = "";
    public const PAYMENT_NOTIFICATION = "PAYMENT_NOTIFICATION";
    public const CHARGE_STATUS_CHANGED = "CHARGE_STATUS_CHANGED";

    protected string $id;

    /** @var string $name Enum: "DOCUMENT_STATUS_CHANGED" "DIGITAL_ACCOUNT_STATUS_CHANGED" "TRANSFER_STATUS_CHANGED" "P2P_TRANSFER_STATUS_CHANGED" "PAYMENT_NOTIFICATION" "CHARGE_STATUS_CHANGED" */
    protected string $name;

    protected string $label;

    /** @var string $status Enum: "ENABLED" "DEPRECATED" */
    protected string $status;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}

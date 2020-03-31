<?php


namespace Jetimob\Juno\Lib\Model;


use Jetimob\Juno\Lib\Traits\Serializable;

class WebhookEventType
{
    use Serializable;

    public const DOCUMENT_STATUS_CHANGED = "DOCUMENT_STATUS_CHANGED";
    public const DIGITAL_ACCOUNT_STATUS_CHANGED = "DIGITAL_ACCOUNT_STATUS_CHANGED";
    public const TRANSFER_STATUS_CHANGED = "TRANSFER_STATUS_CHANGED";
    public const P2P_TRANSFER_STATUS_CHANGED = "";
    public const PAYMENT_NOTIFICATION = "PAYMENT_NOTIFICATION";
    public const CHARGE_STATUS_CHANGED = "CHARGE_STATUS_CHANGED";

    public string $id;

    /** @var string $name Enum: "DOCUMENT_STATUS_CHANGED" "DIGITAL_ACCOUNT_STATUS_CHANGED" "TRANSFER_STATUS_CHANGED" "P2P_TRANSFER_STATUS_CHANGED" "PAYMENT_NOTIFICATION" "CHARGE_STATUS_CHANGED" */
    public string $name;

    public string $label;

    /** @var string $status Enum: "ENABLED" "DEPRECATED" */
    public string $status;
}
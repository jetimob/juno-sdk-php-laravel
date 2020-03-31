<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class WebhookPatchRequest
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/updateWebhook
 */
class WebhookPatchRequest extends Request
{
    public string $id;

    /** @var string $status Enum: "ACTIVE" "INACTIVE" */
    public string $status;

    /** @var string[] $eventTypes Enum: "DOCUMENT_STATUS_CHANGED" "DIGITAL_ACCOUNT_STATUS_CHANGED" "TRANSFER_STATUS_CHANGED" "P2P_TRANSFER_STATUS_CHANGED" "PAYMENT_NOTIFICATION" "CHARGE_STATUS_CHANGED" */
    public array $eventTypes;

    public function __construct(string $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    protected function method(): string
    {
        return Method::PATCH;
    }

    protected function urn(): string
    {
        return 'notifications/webhooks/{id}';
    }
}
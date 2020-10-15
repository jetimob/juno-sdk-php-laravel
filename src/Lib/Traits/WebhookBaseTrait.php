<?php

namespace Jetimob\Juno\Lib\Traits;

use Jetimob\Juno\Lib\Model\WebhookEventType;

trait WebhookBaseTrait
{
    public string $id;

    public string $url;

    public string $secret;

    /** @var string $status Enum: "ACTIVE" "INACTIVE" */
    public string $status;

    /** @var WebhookEventType[] $eventTypes */
    public array $eventTypes;

    public function initComplexObjects(): void
    {
        if (!empty($this->data->eventTypes)) {
            $this->eventTypes = WebhookEventType::deserializeArray($this->data->eventTypes);
        } else {
            $this->eventTypes = [];
        }
    }
}
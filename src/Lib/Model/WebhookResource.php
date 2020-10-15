<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class WebhookResource
{
    use Serializable;

    public string $id;

    public string $url;

    public string $secret;

    /** @var string $status Enum: "ACTIVE" "INACTIVE" */
    public string $status;

    /** @var WebhookEventType[] $eventTypes */
    public array $eventTypes;

    public function isActive(): bool
    {
        return $this->status === 'ACTIVE';
    }

    public function isInactive(): bool
    {
        return !$this->isActive();
    }
}
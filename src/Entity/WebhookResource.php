<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class WebhookResource
{
    use Serializable;

    protected string $id;
    protected string $url;
    protected string $secret;

    /** @var string $status Enum: "ACTIVE" "INACTIVE" */
    protected string $status;

    /** @var WebhookEventType[] $eventTypes */
    protected array $eventTypes;

    protected function isActive(): bool
    {
        return $this->status === 'ACTIVE';
    }

    protected function isInactive(): bool
    {
        return !$this->isActive();
    }

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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @return string Enum: "ACTIVE" "INACTIVE"
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return WebhookEventType[]
     */
    public function getEventTypes(): array
    {
        return $this->eventTypes ?? [];
    }
}

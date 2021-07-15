<?php

namespace Jetimob\Juno\Api\Webhook;

use Jetimob\Juno\Entity\WebhookEventType;

trait WebhookBase
{
    protected string $id;
    protected string $url;
    protected string $secret;
    /** @var string $status Enum: "ACTIVE" "INACTIVE" */
    protected string $status;
    /** @var WebhookEventType[] $eventTypes */
    protected array $eventTypes;

    public function eventTypesItemType(): string
    {
        return WebhookEventType::class;
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
     * @return string
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

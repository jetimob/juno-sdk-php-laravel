<?php

namespace Jetimob\Juno\Api\Webhook\Notification;

use Jetimob\Juno\Entity\WebhookEventType;

trait NotificationBase
{
    protected string $eventId;
    protected string $eventType;
    protected array $data;

    /**
     * @return string
     */
    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * Pode ser um de:
     * - BANK_PAID_BACK
     * - CONFIRMED
     * - PARTIALLY_REFUNDED
     * - CUSTOMER_PAID_BACK
     * - DECLINED
     * - FAILED NOT_AUTHORIZED
     * @return string
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data ?? [];
    }
}

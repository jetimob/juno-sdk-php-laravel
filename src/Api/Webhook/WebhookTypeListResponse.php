<?php

namespace Jetimob\Juno\Api\Webhook;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\WebhookEventType;

/**
 * @link https://dev.juno.com.br/api/v2#operation/getEventTypes
 */
class WebhookTypeListResponse extends EmbeddedResponse
{
    /** @var WebhookEventType[] $eventTypes */
    protected array $eventTypes;

    public function eventTypesItemType(): string
    {
        return WebhookEventType::class;
    }

    /**
     * @return WebhookEventType[]
     */
    public function getEventTypes(): array
    {
        return $this->eventTypes ?? [];
    }
}

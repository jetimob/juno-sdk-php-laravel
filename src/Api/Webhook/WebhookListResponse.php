<?php

namespace Jetimob\Juno\Api\Webhook;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\WebhookResource;

/**
 * @link https://dev.juno.com.br/api/v2#operation/getWebhooks
 */
class WebhookListResponse extends EmbeddedResponse
{
    /** @var WebhookResource[] $webhooks */
    protected array $webhooks;

    /**
     * @return WebhookResource[]
     */
    public function getWebhooks(): array
    {
        return $this->webhooks;
    }
}

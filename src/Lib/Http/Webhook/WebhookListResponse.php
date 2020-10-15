<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\WebhookResource;

/**
 * Class WebhookListResponse
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/getWebhooks
 */
class WebhookListResponse extends Response
{
    public array $webhooks;

    public function initComplexObjects(): void
    {
        $this->webhooks = $this->deserializeEmbeddedArray('webhooks', WebhookResource::class);
    }
}
<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\WebhookEventType;

/**
 * Class WebhookTypeListResponse
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/getEventTypes
 */
class WebhookTypeListResponse extends Response
{
    public array $eventTypes;

    public function initComplexObjects(): void
    {
        $this->eventTypes = $this->deserializeEmbeddedArray('eventTypes', WebhookEventType::class);
    }
}
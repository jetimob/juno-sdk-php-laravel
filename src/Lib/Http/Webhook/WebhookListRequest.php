<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class WebhookListRequest
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/getWebhooks
 */
class WebhookListRequest extends Request
{
    protected function method(): string
    {
        return Method::GET;
    }

    protected function urn(): string
    {
        return 'notifications/webhooks';
    }
}
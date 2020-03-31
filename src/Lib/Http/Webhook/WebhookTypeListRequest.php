<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class WebhookTypeListRequest
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/getEventTypes
 */
class WebhookTypeListRequest extends Request
{
    protected function method(): string
    {
        return Method::GET;
    }

    protected function urn(): string
    {
        return 'notifications/event-types';
    }

}
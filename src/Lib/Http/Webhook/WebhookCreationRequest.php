<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class WebhookCreationRequest
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/createWebhook
 */
class WebhookCreationRequest extends Request
{
    public string $url;

    /** @var string[] $eventTypes */
    public array $eventTypes;

    protected array $bodySchema = [
        'url',
        'eventTypes',
    ];

    protected function method(): string
    {
        return Method::POST;
    }

    protected function urn(): string
    {
        return 'notifications/webhooks';
    }
}
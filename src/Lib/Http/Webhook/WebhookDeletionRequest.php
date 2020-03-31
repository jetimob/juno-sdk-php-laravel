<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class WebhookDeletionRequest
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/deleteWebhook
 */
class WebhookDeletionRequest extends Request
{
    public string $id;

    public function __construct(string $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    protected function method(): string
    {
        return Method::DELETE;
    }

    protected function urn(): string
    {
        return 'notifications/webhooks/{id}';
    }
}
<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class WebhookConsultRequest
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/findWebhook
 */
class WebhookConsultRequest extends Request
{
    public string $id;

    public function __construct(string $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    protected function method(): string
    {
        return Method::GET;
    }

    protected function urn(): string
    {
        return 'notifications/webhooks/{id}';
    }
}
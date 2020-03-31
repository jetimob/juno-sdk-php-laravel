<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Traits\WebhookBaseTrait;

/**
 * Class WebhookCreationResponse
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/createWebhook
 */
class WebhookCreationResponse extends Response
{
    use WebhookBaseTrait;
}
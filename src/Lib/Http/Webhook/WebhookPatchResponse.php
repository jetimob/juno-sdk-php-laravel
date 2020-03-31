<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Traits\WebhookBaseTrait;

/**
 * Class WebhookPatchResponse
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/updateWebhook
 */
class WebhookPatchResponse extends Response
{
    use WebhookBaseTrait;
}
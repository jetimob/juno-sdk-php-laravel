<?php

namespace Jetimob\Juno\Lib\Http\Webhook;

use Jetimob\Juno\Lib\Http\Response;

/**
 * Class WebhookConsultResponse
 * @package Jetimob\Juno\Lib\Http\Webhook
 * @see https://dev.juno.com.br/api/v2#operation/findWebhook
 */
class WebhookConsultResponse extends Response
{
    use WebhookBaseTrait;
}
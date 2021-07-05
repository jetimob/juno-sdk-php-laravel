<?php

namespace Jetimob\Juno\Api\Subscription;

use Jetimob\Juno\Api\JunoResponse;
use Jetimob\Juno\Entity\SubscriptionBase;

/**
 * @link https://dev.juno.com.br/api/v2#operation/createSubscription
 */
class CreateSubscriptionResponse extends JunoResponse
{
    use SubscriptionBase;
}

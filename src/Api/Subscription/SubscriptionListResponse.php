<?php

namespace Jetimob\Juno\Api\Subscription;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\CreateSubscriptionResource;

/**
 * @link https://dev.juno.com.br/api/v2#operation/listSubscriptions
 */
class SubscriptionListResponse extends EmbeddedResponse
{
    /** @var CreateSubscriptionResource[] $subscriptions */
    protected array $subscriptions;

    public function subscriptionsItemType(): string
    {
        return CreateSubscriptionResource::class;
    }

    /**
     * @return CreateSubscriptionResource[]
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions ?? [];
    }
}

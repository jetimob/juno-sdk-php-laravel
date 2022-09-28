<?php

namespace Jetimob\Juno\Api\Subscription;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\CreatePlansResource;

/**
 * @link https://dev.juno.com.br/api/v2#operation/listPlans
 */
class PlanListResponse extends EmbeddedResponse
{
    /** @var CreatePlansResource[] $plans */
    protected array $plans;

    public function plansItemType(): string
    {
        return CreatePlansResource::class;
    }

    /**
     * @return CreatePlansResource[]
     */
    public function getPlans(): array
    {
        return $this->plans ?? [];
    }
}

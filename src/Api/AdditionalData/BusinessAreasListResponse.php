<?php

namespace Jetimob\Juno\Api\AdditionalData;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\BusinessAreaResource;

class BusinessAreasListResponse extends EmbeddedResponse
{
    /** @var BusinessAreaResource[] $businessAreas */
    protected array $businessAreas;

    public function businessAreasItemType(): string
    {
        return BusinessAreaResource::class;
    }

    /**
     * @return BusinessAreaResource[]
     */
    public function getBusinessAreas(): array
    {
        return $this->businessAreas ?? [];
    }
}

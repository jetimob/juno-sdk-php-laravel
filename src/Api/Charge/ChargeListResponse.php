<?php

namespace Jetimob\Juno\Api\Charge;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\ChargeResource;

class ChargeListResponse extends EmbeddedResponse
{
    /** @var ChargeResource[] $charges */
    protected array $charges;

    public function chargesItemType(): string
    {
        return ChargeResource::class;
    }

    /**
     * @return ChargeResource[]
     */
    public function getCharges(): array
    {
        return $this->charges ?? [];
    }
}

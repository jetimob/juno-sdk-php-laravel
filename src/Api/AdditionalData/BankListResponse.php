<?php

namespace Jetimob\Juno\Api\AdditionalData;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\BankResource;

class BankListResponse extends EmbeddedResponse
{
    /** @var BankResource[] $banks */
    protected array $banks;

    public function banksItemType(): string
    {
        return BankResource::class;
    }

    /**
     * @return BankResource[]
     */
    public function getBanks(): array
    {
        return $this->banks ?? [];
    }
}

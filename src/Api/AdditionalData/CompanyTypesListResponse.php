<?php

namespace Jetimob\Juno\Api\AdditionalData;

use Jetimob\Juno\Api\JunoResponse;

class CompanyTypesListResponse extends JunoResponse
{
    /** @var string[] $companyTypes */
    protected array $companyTypes;

    public function companyTypesItemType(): string
    {
        return 'string';
    }

    /**
     * @return string[]
     */
    public function getCompanyTypes(): array
    {
        return $this->companyTypes ?? [];
    }
}

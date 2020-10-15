<?php

namespace Jetimob\Juno\Lib\Http\ExtraData;

use Jetimob\Juno\Lib\Http\Response;

/**
 * Class ExtraCompanyTypesResponse
 * @package Jetimob\Juno\Lib\Http\ExtraData
 * @see https://dev.juno.com.br/api/v2#operation/getCompanyTypes
 */
class ExtraCompanyTypesResponse extends Response
{
    /** @var string[] $companyTypes */
    public array $companyTypes;

    public function initComplexObjects(): void
    {
        $this->companyTypes = !empty($this->data->companyTypes) ? $this->data->companyTypes : [];
    }
}

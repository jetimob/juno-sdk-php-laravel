<?php

namespace Jetimob\Juno\Lib\Http\ExtraData;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class ExtraCompanyTypesRequest
 * @package Jetimob\Juno\Lib\Http\ExtraData
 * @see https://dev.juno.com.br/api/v2#operation/getCompanyTypes
 */
class ExtraCompanyTypesRequest extends Request
{
    /**
     * @inheritDoc
     */
    protected function method(): string
    {
        return Method::GET;
    }

    /**
     * @inheritDoc
     */
    protected function urn(): string
    {
        return 'data/company-types';
    }
}

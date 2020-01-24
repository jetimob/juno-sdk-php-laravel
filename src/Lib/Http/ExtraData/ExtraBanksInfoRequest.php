<?php

namespace Jetimob\Juno\Lib\Http\ExtraData;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

class ExtraBanksInfoRequest extends Request
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
        return 'data/banks';
    }
}

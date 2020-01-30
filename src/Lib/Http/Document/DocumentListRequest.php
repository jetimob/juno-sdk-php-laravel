<?php

namespace Jetimob\Juno\Lib\Http\Document;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class DocumentListRequest
 * @package Jetimob\Juno\Lib\Http\Document
 * @see https://dev.juno.com.br/api/v2#operation/getDocuments
 */
class DocumentListRequest extends Request
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
        return 'documents';
    }
}

<?php

namespace Jetimob\Juno\Lib\Http\Document;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class DocumentConsultRequest
 * @package Jetimob\Juno\Lib\Http\Document
 * @see https://dev.juno.com.br/api/v2#operation/getDocumentsById
 */
class DocumentConsultRequest extends Request
{
    public string $id;

    /**
     * DocumentConsultRequest constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
        parent::__construct();
    }

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
        return 'documents/{id}';
    }
}

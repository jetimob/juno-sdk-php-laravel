<?php

namespace Jetimob\Juno\Lib\Http\Document;

use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Lib\Model\DocumentResource;

/**
 * Class DocumentListResponse
 * @package Jetimob\Juno\Lib\Http\Document
 * @see https://dev.juno.com.br/api/v2#operation/getDocuments
 */
class DocumentListResponse extends Response
{
    /** @var DocumentResource[] $documents */
    public array $documents;

    public function initComplexObjects(): void
    {
        $this->documents = $this->deserializeEmbeddedArray('documents', DocumentResource::class);
    }
}

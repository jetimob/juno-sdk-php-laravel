<?php

namespace Jetimob\Juno\Api\Document;

use Jetimob\Juno\Api\EmbeddedResponse;
use Jetimob\Juno\Entity\DocumentResource;

/**
 * @link https://dev.juno.com.br/api/v2#operation/getDocuments
 */
class DocumentListResponse extends EmbeddedResponse
{
    /** @var DocumentResource[] $documents */
    protected array $documents;

    public function documentsItemType(): string
    {
        return DocumentResource::class;
    }

    /**
     * @return DocumentResource[]
     */
    public function getDocuments(): array
    {
        return $this->documents ?? [];
    }
}

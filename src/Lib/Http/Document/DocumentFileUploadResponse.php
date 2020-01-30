<?php

namespace Jetimob\Juno\Lib\Http\Document;

use Jetimob\Juno\Lib\Http\Response;

/**
 * Class DocumentFileUploadResponse
 * @package Jetimob\Juno\Lib\Http\Document
 * @see https://dev.juno.com.br/api/v2#operation/uploadDocument
 */
class DocumentFileUploadResponse extends Response
{
    /** @var string $id <ObjectId> */
    public string $id;

    public string $type;

    public string $description;

    /**
     * @var string $approvalStatus
     * Possible values:
     *  - AWAITING
     *  - VERIFYING
     *  - APPROVED
     *  - REJECTED
     */
    public string $approvalStatus;

    public ?string $rejectionReason;

    public ?string $details;
}

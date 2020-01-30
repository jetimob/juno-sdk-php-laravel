<?php

namespace Jetimob\Juno\Lib\Http\Document;

use Jetimob\Juno\Lib\Http\Response;

/**
 * Class DocumentConsultResponse
 * @package Jetimob\Juno\Lib\Http\Document
 * @see https://dev.juno.com.br/api/v2#operation/getDocumentsById
 */
class DocumentConsultResponse extends Response
{
    /** @var string $id <ObjectId> */
    public string $id;

    public string $type;

    public string $description;

    public string $approvalStatus;

    public ?string $rejectionReason;

    public ?string $details;
}

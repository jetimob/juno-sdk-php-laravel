<?php

namespace Jetimob\Juno\Lib\Model;

use Jetimob\Juno\Lib\Traits\Serializable;

class DocumentResource
{
    use Serializable;

    /** @var string $id <ObjectId> */
    public string $id;

    public string $type;

    public string $description;

    public string $approvalStatus;

    public ?string $rejectionReason;

    public ?string $details;
}

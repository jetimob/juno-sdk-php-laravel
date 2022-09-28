<?php

namespace Jetimob\Juno\Entity;

use Jetimob\Http\Traits\Serializable;

class DocumentResource
{
    use Serializable;

    /** @var string $id <ObjectId> */
    protected string $id;

    protected string $type;

    protected string $description;

    protected string $approvalStatus;

    protected ?string $rejectionReason = null;

    protected ?string $details = null;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getApprovalStatus(): string
    {
        return $this->approvalStatus;
    }

    /**
     * @return string|null
     */
    public function getRejectionReason(): ?string
    {
        return $this->rejectionReason;
    }

    /**
     * @return string|null
     */
    public function getDetails(): ?string
    {
        return $this->details;
    }
}

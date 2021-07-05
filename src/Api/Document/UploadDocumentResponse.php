<?php

namespace Jetimob\Juno\Api\Document;

use Jetimob\Juno\Api\JunoResponse;

/**
 * @link https://dev.juno.com.br/api/v2#operation/uploadDocument
 */
class UploadDocumentResponse extends JunoResponse
{
    /** @var string $id <ObjectId> */
    protected string $id;
    protected string $type;
    protected string $description;
    protected string $approvalStatus;
    protected ?string $rejectionReason;
    protected ?string $details;

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
     * Possible values:
     *  - AWAITING
     *  - VERIFYING
     *  - APPROVED
     *  - REJECTED
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

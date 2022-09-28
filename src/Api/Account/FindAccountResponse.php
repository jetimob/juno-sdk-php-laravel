<?php

namespace Jetimob\Juno\Api\Account;

use Jetimob\Juno\Api\JunoResponse;

/**
 * @link https://dev.juno.com.br/api/v2#operation/findDigitalAccount
 */
class FindAccountResponse extends JunoResponse
{
    protected string $id;
    protected string $type;
    protected string $status;
    protected string $personType;
    protected string $document;
    protected string $createdOn;
    protected string $accountNumber;

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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getPersonType(): string
    {
        return $this->personType;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * @return string
     */
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }
}

<?php

namespace Jetimob\Juno\Api\Account;

use Jetimob\Juno\Api\JunoResponse;

/**
 * @link https://dev.juno.com.br/api/v2#operation/createDigitalAccount
 */
class CreateAccountResponse extends JunoResponse
{
    protected string $id;
    protected string $resourceToken;

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
    public function getResourceToken(): string
    {
        return $this->resourceToken;
    }
}

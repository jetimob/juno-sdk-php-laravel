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
}

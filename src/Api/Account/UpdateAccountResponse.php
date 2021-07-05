<?php

namespace Jetimob\Juno\Api\Account;

use Jetimob\Juno\Api\JunoResponse;

/**
 * @link https://dev.juno.com.br/api/v2#operation/updateDigitalAccount
 */
class UpdateAccountResponse extends JunoResponse
{
    protected string $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}

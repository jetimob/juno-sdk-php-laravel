<?php

namespace Jetimob\Juno\Api\Pix;

use Jetimob\Juno\Api\JunoResponse;

/**
 * @link https://dev.juno.com.br/api/v2#operation/createPixKey
 */
class CreatePixKeyResponse extends JunoResponse
{
    protected string $key;
    protected string $creationDateTime;
    protected string $ownershipDateTime;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string - yyyy-MM-ddTHH:mm:ss.sssZ
     */
    public function getCreationDateTime(): string
    {
        return $this->creationDateTime;
    }

    /**
     * @return string - yyyy-MM-ddTHH:mm:ss.sssZ
     */
    public function getOwnershipDateTime(): string
    {
        return $this->ownershipDateTime;
    }
}

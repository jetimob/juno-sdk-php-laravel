<?php

namespace Jetimob\Juno\Lib\Http\Authorization;

use Jetimob\Juno\Lib\Http\Response;
use Serializable;

class AuthorizationResponse extends Response implements Serializable
{
    protected string $access_token;

    protected string $token_type;

    protected int $expires_in;

    protected string $scope;

    protected string $user_name;

    protected string $jti;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->token_type;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @return string
     */
    public function getJti(): string
    {
        return $this->jti;
    }

    /**
     * @inheritDoc
     */
    public function serialize(): string
    {
        return serialize([
            $this->access_token,
            $this->token_type,
            $this->expires_in,
            $this->scope,
            $this->user_name,
            $this->jti,
            $this->getTimestamp(),
            $this->getStatusCode(),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized): void
    {
        [
            $this->access_token,
            $this->token_type,
            $this->expires_in,
            $this->scope,
            $this->user_name,
            $this->jti,
            $timestamp,
            $statusCode,
        ] = unserialize($serialized, ['allowed_classes' => false]);

        $this->setTimestamp($timestamp);
        $this->setStatusCode($statusCode);
    }
}

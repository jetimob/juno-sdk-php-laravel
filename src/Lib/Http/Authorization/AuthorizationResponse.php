<?php

namespace Jetimob\Juno\Lib\Http\Authorization;

use Jetimob\Juno\Lib\Http\Response;

class AuthorizationResponse extends Response implements \Serializable
{
    protected string $access_token;

    protected string $token_type;

    protected int $expires_in;

    protected string $scope;

    protected string $user_name;

    protected string $jti;

    // override father class properties so we can serialize them
    protected int $timestamp;

    protected int $statusCode;

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
    public function serialize()
    {
        return serialize([
            $this->access_token,
            $this->token_type,
            $this->expires_in,
            $this->scope,
            $this->user_name,
            $this->jti,
            $this->timestamp,
            $this->statusCode,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        list(
            $this->access_token,
            $this->token_type,
            $this->expires_in,
            $this->scope,
            $this->user_name,
            $this->jti,
            $this->timestamp,
            $this->statusCode,
        ) = unserialize($serialized);
    }
}

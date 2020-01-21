<?php

namespace Jetimob\Juno\Lib\Http\Authorization;

use Jetimob\Juno\Lib\Http\Response;

class AuthorizationResponse extends Response
{
    protected string $access_token;

    protected string $token_type;

    protected int $expires_in;

    protected string $scope;

    protected string $user_name;

    protected string $jti;
}

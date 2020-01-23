<?php

namespace Jetimob\Juno\Lib\Http\Authorization;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

class AuthorizationRequest extends Request
{
    protected string $grant_type = 'client_credentials';

    protected array $bodySchema = ['grant_type'];

    protected bool $jsonBody = false;

    protected function method(): string
    {
        return Method::POST;
    }

    protected function urn(): string
    {
        return 'oauth/token';
    }
}

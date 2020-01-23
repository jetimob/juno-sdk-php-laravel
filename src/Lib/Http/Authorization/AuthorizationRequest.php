<?php

namespace Jetimob\Juno\Lib\Http\Authorization;

use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

class AuthorizationRequest extends Request
{
    protected string $grant_type = 'client_credentials';

    protected string $method = Method::POST;

    protected string $urn = 'oauth/token';

    protected array $bodySchema = ['grant_type'];

    protected string $responseClass = AuthorizationResponse::class;

    protected bool $jsonBody = false;
}

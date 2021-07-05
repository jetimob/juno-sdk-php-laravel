<?php

namespace Jetimob\Juno\Api;

use Jetimob\Http\Authorization\OAuth\OAuthFlow;
use Jetimob\Http\Request;

class AuthorizedRequest extends Request
{
    public function __construct($method, $uri, array $headers = [], $body = null)
    {
        parent::__construct($method, $uri, $headers, $body, OAuthFlow::CLIENT_CREDENTIALS);
    }
}

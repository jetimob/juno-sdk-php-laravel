<?php

namespace Jetimob\Juno\Lib\Http\Authorization;

use Jetimob\Juno\Lib\Http\BodyType;
use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

class AuthorizationRequest extends Request
{
    protected string $grant_type = 'client_credentials';

    protected array $bodySchema = ['grant_type'];

    protected string $bodyType = BodyType::FORM_PARAMS;

    /**
     * @inheritDoc
     */
    protected function method(): string
    {
        return Method::POST;
    }

    /**
     * @inheritDoc
     */
    protected function urn(): string
    {
        return 'oauth/token';
    }
}

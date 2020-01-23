<?php

namespace Jetimob\Juno\Lib\Http;

class ErrorResponse extends Response
{
    protected string $timestamp;

    protected int $status;

    protected string $error;

    protected array $details;

    protected string $path;
}

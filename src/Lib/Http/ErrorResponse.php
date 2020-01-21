<?php

namespace Jetimob\Juno\Lib\Http;

use Psr\Http\Message\ResponseInterface;
use Throwable;

class ErrorResponse extends Response implements Throwable
{
    protected string $timestamp;

    protected int $status;

    protected string $error;

    protected array $details;

    protected string $path;

    private array $stack;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
        $this->stack = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    }

    public function getMessage()
    {
        return '';
    }

    public function getCode()
    {
        return 0;
    }

    public function getFile()
    {
        return $this->stack[1]['file'];
    }

    public function getLine()
    {
        return $this->stack[1]['line'];
    }

    public function getTrace()
    {
        return $this->stack;
    }

    public function getTraceAsString()
    {
        return json_encode($this->stack);
    }

    public function getPrevious()
    {
        return $this->stack[1];
    }
}

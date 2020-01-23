<?php

namespace Jetimob\Juno\Exception;

use Jetimob\Juno\Lib\Http\Response;

class WrongResponseTypeException extends JunoException
{
    public function __construct()
    {
        parent::__construct(sprintf('every response object MUST extend the base %s class', Response::class));
    }
}

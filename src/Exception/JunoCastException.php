<?php

namespace Jetimob\Juno\Exception;

use Throwable;

class JunoCastException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}

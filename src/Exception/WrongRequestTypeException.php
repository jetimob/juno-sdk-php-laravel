<?php

namespace Jetimob\Juno\Exception;

use Jetimob\Juno\Lib\Http\Request;

class WrongRequestTypeException extends JunoException
{
    public function __construct($givenObject)
    {
        parent::__construct(sprintf(
            'juno\'s request expects a object that extends %s, %s given',
            Request::class,
            is_null($givenObject) ? 'NULL' : get_class($givenObject),
        ));
    }

}

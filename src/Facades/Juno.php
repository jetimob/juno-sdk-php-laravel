<?php

namespace Jetimob\Juno\Facades;

use Illuminate\Support\Facades\Facade;

class Juno extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'juno';
    }
}

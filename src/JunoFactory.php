<?php

namespace Jetimob\Juno;

use Jetimob\Juno\Lib\Billet;

class JunoFactory
{
    public static function make(string $class)
    {
        switch ($class) {
            case 'billet':
                return new Billet();
        }

        return null;
    }
}

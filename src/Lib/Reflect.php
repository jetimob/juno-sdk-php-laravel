<?php

namespace Jetimob\Juno\Lib;

use Jetimob\Juno\Util\Log;

class Reflect
{
    public static function properties(int $filter, $instance)
    {
        try {
            $refl = new \ReflectionClass($instance);
            return $refl->getProperties($filter);
        } catch (\ReflectionException $e) {
            Log::error($e);
        }

        return [];
    }

    public static function property($name, $instance)
    {
        try {
            $refl = new \ReflectionClass($instance);
            return $refl->getProperty($name);
        } catch (\ReflectionException $e) {
            return null;
        }
    }
}

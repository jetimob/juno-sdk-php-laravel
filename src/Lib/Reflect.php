<?php

namespace Jetimob\Juno\Lib;

use Jetimob\Juno\Util\Log;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class Reflect
{
    public static function properties(int $filter, $instance): array
    {
        try {
            $refl = new ReflectionClass($instance);
            return $refl->getProperties($filter);
        } catch (ReflectionException $e) {
            Log::error($e);
        }

        return [];
    }

    public static function property($name, $instance): ?ReflectionProperty
    {
        try {
            $refl = new ReflectionClass($instance);
            return $refl->getProperty($name);
        } catch (ReflectionException $e) {
            return null;
        }
    }
}

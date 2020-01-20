<?php

namespace Jetimob\Juno\Lib;

use Illuminate\Support\Facades\Log;

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
}

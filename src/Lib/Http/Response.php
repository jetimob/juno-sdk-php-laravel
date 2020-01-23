<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Lib\Reflect;
use Jetimob\Juno\Lib\Traits\Serializable;
use ReflectionProperty;

abstract class Response
{
    use Serializable;

    private int $timestamp;

    public function __construct()
    {
        $this->timestamp = time();
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return bool
     */
    public function failed()
    {
        return $this instanceof ErrorResponse;
    }

    public function initComplexObjects()
    {
    }

    public function __toString()
    {
        $fPrintProp = function (array $properties) {
            $data = [];

            foreach ($properties as $p) {
                if (empty($this->{$p})) {
                    continue;
                }

                $data[$p] = $this->{$p};
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        };

        if ($this->failed()) {
            return $fPrintProp(['timestamp', 'status', 'error', 'details', 'path']);
        }

        $props = Reflect::properties(ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PUBLIC, $this);
        $propsNames = [];

        foreach ($props as $p) {
            $propsNames[] = $p->getName();
        }

        return $fPrintProp($propsNames);
    }
}

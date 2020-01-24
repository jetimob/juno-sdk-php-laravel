<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Lib\Reflect;
use Jetimob\Juno\Lib\Traits\Serializable;
use ReflectionProperty;

abstract class Response
{
    use Serializable;

    private int $timestamp;

    private int $statusCode;

    public function __construct()
    {
        $this->timestamp = time();
    }

    /**
     * Returns the timestamp that the response was constructed.
     *
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * True if this response failed, false otherwise.
     *
     * @return bool
     */
    public function failed()
    {
        return $this instanceof ErrorResponse;
    }

    /**
     * Returns the response status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $code): void
    {
        if (!empty($this->statusCode)) {
            return;
        }

        $this->statusCode = $code;
    }

    /**
     * Complex objects (non native) require manual initialization. Override this function to correctly initialize an
     * object instance.
     */
    public function initComplexObjects()
    {
    }

    public function __toString()
    {
        $fPrintProp = function (array $properties) {
            $data = [];

            foreach ($properties as $p) {
                if (!isset($this->{$p}) || is_null($this->{$p})) {
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

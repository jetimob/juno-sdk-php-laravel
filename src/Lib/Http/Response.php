<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Lib\Reflect;
use Jetimob\Juno\Lib\Traits\Serializable;
use ReflectionProperty;

abstract class Response
{
    use Serializable;

    protected int $timestamp;

    protected int $statusCode;

    public function __construct()
    {
        $this->timestamp = time();
    }

    /**
     * Returns the timestamp that the response was constructed with.
     *
     * @return int
     */
    final public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * Overrides the response timestamp. This is needed to deserialize Juno's cached authorization response.
     *
     * @param $timestamp
     */
    final protected function setTimestamp($timestamp): void
    {
        if (isset($this->timestamp)) {
            return;
        }

        $this->timestamp = $timestamp;
    }

    /**
     * True if this response failed, false otherwise.
     *
     * @return bool
     */
    final public function failed(): bool
    {
        return $this instanceof ErrorResponse;
    }

    /**
     * True if this response succeeded, false otherwise.
     *
     * @return bool
     */
    final public function succeeded(): bool
    {
        return !$this->failed();
    }

    /**
     * Returns the response status code.
     *
     * @return int
     */
    final public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Overrides the response status code. Used for deserialization from cached data.
     *
     * @param int $code
     */
    final public function setStatusCode(int $code): void
    {
        if (isset($this->statusCode)) {
            return;
        }

        $this->statusCode = $code;
    }

    /**
     * Returns true if there is an embedded object with the given key, false otherwise.
     *
     * @param string $key the object key to look for
     * @return bool true if there is an embedded object with the given key, false otherwise.
     */
    final public function hasEmbeddedData(string $key): bool
    {
        return !empty($this->data->_embedded) && !empty($this->data->_embedded->{$key});
    }

    /**
     * Returns an object if the response object has embedded data and $key is present, null otherwise.
     *
     * @param string $key the object key to look for
     * @return array|object|null an object if the response object has embedded data and $key is present, null otherwise.
     */
    final public function getEmbeddedData(string $key)
    {
        return $this->hasEmbeddedData($key) ? $this->data->_embedded->{$key} : null;
    }

    /**
     * @param string $key the object key to look for
     * @param string $class the serializable class (MUST use Serializable trait)
     * @param mixed $default default value to return when the key is not present
     * @param string $func the class function responsible to deserialize the object
     * @return mixed
     */
    private function deserializeEmbedded(string $key, string $class, $default, string $func)
    {
        $data = $this->getEmbeddedData($key);

        if (is_null($data)) {
            return $default;
        }

        return method_exists($class, $func) ? $class::{$func}($data) : $default;
    }

    /**
     * Will try to find $key in the response's embedded data and if there is something, will deserialize with the given
     * class name. Will return $default if there is no object or embedded data.
     *
     * @param string $key the object key to look for
     * @param string $class the serializable class (MUST use Serializable trait)
     * @param null $default default value to return when the key is not present
     * @return mixed
     */
    final public function deserializeEmbeddedData(string $key, string $class, $default = null)
    {
        return $this->deserializeEmbedded($key, $class, $default, 'deserialize');
    }

    /**
     * Will try to find $key in the response's embedded data and if there is something, will deserialize with the given
     * class name. Will return $default if there is no object or embedded data.
     *
     * @param string $key the object key to look for
     * @param string $class the serializable class (MUST use Serializable trait)
     * @param array $default default value to return when the key is not present
     * @return mixed
     */
    final public function deserializeEmbeddedArray(string $key, string $class, $default = [])
    {
        return $this->deserializeEmbedded($key, $class, $default, 'deserializeArray');
    }

    /**
     * Complex objects (non native) require manual initialization. Override this function to correctly initialize an
     * object instance.
     */
    public function initComplexObjects(): void
    {
    }

    public function __toString()
    {
        $fPrintProp = function (array $properties): string {
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
            return $fPrintProp(['timestamp', 'statusCode', 'error', 'details', 'path']);
        }

        $props = Reflect::properties(ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PUBLIC, $this);
        $propsNames = [];

        foreach ($props as $p) {
            $propsNames[] = $p->getName();
        }

        return $fPrintProp($propsNames);
    }
}

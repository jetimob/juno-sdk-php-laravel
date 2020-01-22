<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Exception\JunoResponseException;
use Jetimob\Juno\Lib\Reflect;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Facades\Log;
use ReflectionProperty;

abstract class Response
{
    private bool $successful;

    private int $code;

//    /**
//     * JunoResponse constructor.
//     * @param ResponseInterface $response
//     * @throws JunoResponseException
//     */
//    public function __construct()
//    {
////        if ($data === null || $data === false) {
////            throw new JunoResponseException('unable to decode Juno\'s API response');
////        }
//    }

    /**
     * @param array|ResponseInterface $response
     * @return $this
     */
    public static function deserialize($response): Response
    {
        if ($response instanceof ResponseInterface) {
            $data = $response->getBody()->getContents();
        } else {
            $data = $response;
        }

        $className = get_called_class();
        $instance = new $className();

        if (is_string($data)) {
            $data = json_decode($data);
        }

        foreach ($data as $key => $value) {
            if (!property_exists($instance, $key)) {
                continue;
            }

            $instance->{$key} = $value;
        }

        return $instance;
    }

    public static function deserializeArray(array $data)
    {
        $data = json_decode($data);
        $items = [];

        foreach ($data as $item) {
            $items[] = self::deserialize($item);
        }

        return $items;
    }

    public function failed()
    {
        return $this instanceof ErrorResponse;
    }

    /**
     * This function MUST be response specific as at this point there is no way to cast the
     * @param array $objectData
     * @return mixed
     */
    abstract protected function initComplexObjects(array $objectData);

    public function __toString()
    {
        $fPrintProp = function (array $properties) {
            $data = [];

            foreach ($properties as $p) {
                $data[$p] = $this->{$p};
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        };

        if ($this->failed()) {
            return $fPrintProp(['timestamp', 'status', 'error', 'details', 'path']);
        }

        $props = Reflect::properties(ReflectionProperty::IS_PROTECTED, $this);
        $propsNames = [];

        foreach ($props as $p) {
            $propsNames[] = $p->getName();
        }

        return $fPrintProp($propsNames);
    }
}

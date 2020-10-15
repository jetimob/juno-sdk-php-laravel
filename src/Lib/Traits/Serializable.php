<?php

namespace Jetimob\Juno\Lib\Traits;

use Jetimob\Juno\Lib\Reflect;
use Jetimob\Juno\Util\Log;

trait Serializable
{
    protected object $data;

    /**
     * @param string|array $response
     * @param string|null $into
     * @return $this
     */
    public static function deserialize($response, string $into = null): self
    {
        if (is_array($response)) {
            $data = $response;
        } elseif (is_string($response)) {
            $data = json_decode($response);
        } else {
            $data = json_decode(json_encode($response));
        }

        $className = $into ?? get_called_class();
        $instance = new $className();

        if (is_string($data)) {
            $data = json_decode($data);
        }

        if (empty($data)) {
            return $instance;
        }

        foreach ($data as $key => $value) {
            if (!property_exists($instance, $key) || !empty($instance->{$key})) {
                continue;
            }

            $prop = Reflect::property($key, $instance);

            if (is_null($prop)) {
                continue;
            }

            if (!$prop->getType()->isBuiltin()) {
                $expectedClass = $prop->getType()->getName();

                if (method_exists($expectedClass, __FUNCTION__)) {
                    try {
                        $instance->{$key} = $expectedClass::{__FUNCTION__}($value, $expectedClass);
                    } catch (\TypeError $e) {
                        Log::error('unable to cast data into expected class instance', [
                            'expected' => $expectedClass,
                            'current' => $className,
                        ]);
                        continue;
                    }
                }
            } elseif (is_array($value)) {
                continue;
            } else {
                $instance->{$key} = $value;
            }
        }

        if (method_exists($instance, 'setData')) {
            $instance->setData($data);
        }

        return $instance;
    }

    public function setData(object $data): void
    {
        $this->data = $data;
    }

    /**
     * @return object
     */
    public function getData(): object
    {
        return $this->data;
    }

    public static function deserializeArray(array $data): array
    {
        $items = [];

        foreach ($data as $item) {
            $items[] = self::deserialize($item);
        }

        return $items;
    }
}

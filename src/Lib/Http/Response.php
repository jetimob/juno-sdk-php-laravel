<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Exception\JunoResponseException;
use Jetimob\Juno\Lib\Model\ErrorDetail;
use Jetimob\Juno\Lib\Reflect;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Facades\Log;
use ReflectionProperty;

abstract class Response
{
    private bool $successful;

    private int $code;

    /**
     * JunoResponse constructor.
     * @param ResponseInterface $response
     * @throws JunoResponseException
     */
    public function __construct(ResponseInterface $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        $this->code = $response->getStatusCode();

        if ($data === null || $data === false) {
            throw new JunoResponseException('unable to decode Juno\'s API response');
        }

        if (array_key_exists('error', $data)) {
            $this->constructFromError($data);
        } else {
            $this->constructFromSuccess($data);
        }
    }

    private function constructFromError(array $body)
    {
        $this->successful = false;
        $this->mergeArrayIntoInstance($body);
//        $this->timestamp = $body['timestamp'];
//        $this->status = $body['status'];
//        $this->error = $body['error'];
//        $this->details = [];
//        $this->path = $body['path'];
//
//        if (is_array($details = $body['details']) && count($details) > 0) {
//            foreach ($details as $detail) {
//                if (!is_array($detail)) {
//                    $detail = json_decode(json_encode($detail), true);
//                }
//
//                if (
//                    !array_key_exists('message', $detail) ||
//                    !array_key_exists('errorCode', $detail)
//                ) {
//                    continue;
//                }
//
//                $this->details[] = new ErrorDetail(
//                    $detail['message'],
//                    $detail['errorCode'],
//                    $detail['string'] ?? '',
//                );
//            }
//        }
    }

    private function mergeArrayIntoInstance(array $data): void
    {
        $protectedProperties = Reflect::properties(ReflectionProperty::IS_PROTECTED, $this);

        foreach ($protectedProperties as $property) {
            $pName = $property->getName();

            if (!array_key_exists($pName, $data)) {
                Log::warning('missing property in array', [
                    'property' => $pName,
                    'data' => $data,
                ]);
                continue;
            }

            $this->{$property} = $data[$pName];
        }
    }

    private function constructFromSuccess(array $body)
    {
        $this->successful = true;
        $this->mergeArrayIntoInstance($body);
    }

    public function __toString()
    {
        $fPrintProp = function (array $properties) {
            $data = [];

            foreach ($properties as $p) {
                $data[$p] = $this->{$p};
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        };

        if (!$this->successful) {
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

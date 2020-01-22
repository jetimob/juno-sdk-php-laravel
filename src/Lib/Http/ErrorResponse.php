<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Lib\Model\ErrorDetail;

class ErrorResponse extends Response
{
    protected string $timestamp;

    protected int $status;

    protected string $error;

    protected array $details;

    protected string $path;

    protected function initComplexObjects(array $data)
    {
        $details = $data['details'] ?? [];
        $this->details = [];

        foreach ($details as $detail) {
            if (!is_array($detail)) {
                $detail = json_decode(json_encode($detail), true);
            }

            if (
                !array_key_exists('message', $detail) ||
                !array_key_exists('errorCode', $detail)
            ) {
                continue;
            }

            $this->details[] = new ErrorDetail(
                $detail['message'],
                $detail['errorCode'],
                $detail['string'] ?? '',
            );
        }
    }
}

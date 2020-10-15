<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Lib\Model\ErrorDetail;

class ErrorResponse extends Response
{
    /** @var string $error HTTP Status Code message */
    protected string $error;

    /** @var ErrorDetail[] $details */
    protected array $details;

    /** @var string $path urn that caused an error */
    protected string $path;

    public function initComplexObjects(): void
    {
        if (!isset($this->data->details) || !is_array($this->data->details)) {
            $this->details = [];
            return;
        }

        $this->details = ErrorDetail::deserializeArray($this->data->details);
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error ?? 'UNKNOWN';
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details ?? [];
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path ?? 'UNKNOWN';
    }
}

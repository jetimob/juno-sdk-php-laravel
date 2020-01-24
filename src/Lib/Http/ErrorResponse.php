<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Lib\Model\ErrorDetail;

class ErrorResponse extends Response
{
    protected int $status;

    protected string $error;

    protected array $details;

    protected string $path;

    public function initComplexObjects()
    {
        if (!isset($this->data->details) || !is_array($this->data->details)) {
            return;
        }

        $this->details = ErrorDetail::deserializeArray($this->data->details);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}

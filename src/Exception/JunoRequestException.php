<?php

namespace Jetimob\Juno\Exception;

use GuzzleHttp\Exception\RequestException;
use Jetimob\Http\Contracts\HydratableContract;
use Jetimob\Http\Traits\Serializable;
use Jetimob\Juno\Entity\ErrorDetail;

class JunoRequestException extends RequestException implements JunoException, HydratableContract
{
    use Serializable;

    protected ?string $timestamp = null;
    protected ?int $status = null;
    protected ?string $error = null;
    protected ?string $path = null;

    /** @var ErrorDetail[] $details */
    protected ?array $details = null;

    public function detailsItemType(): string
    {
        return ErrorDetail::class;
    }

    /**
     * @return string|null
     */
    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error ?? $this->getMessage();
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return ErrorDetail[]
     */
    public function getDetails(): array
    {
        return $this->details ?? [];
    }

    public function hasDetails(): bool
    {
        return !is_null($this->details);
    }
}

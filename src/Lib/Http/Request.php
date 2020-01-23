<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Exception\MissingPropertyBodySchemaException;
use Jetimob\Juno\Util\Console;
use Jetimob\Juno\Util\Log;

abstract class Request
{
    protected string $method;

    protected string $urn;

    protected string $responseClass;

    protected array $bodySchema = [];

    protected bool $jsonBody = true;

    private int $timestamp;

    public function __construct()
    {
        $this->timestamp = time();
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUrn(): string
    {
        $matches = [];
        $urn = $this->urn;

        if (preg_match('/{([[:alpha:]]+?)}/', $this->urn, $matches)) {
            if (count($matches) > 2) {
                Log::warning('only one urn property mapping available at the current time');
            }
            $urn = preg_replace('/{[[:alpha:]]+?}/', $this->{$matches[1]}, $urn);
        }

        return $urn;
    }

    /**
     * @return string
     */
    public function getResponseClass(): string
    {
        return $this->responseClass;
    }

    /**
     * @return array
     */
    public function getBodySchema(): array
    {
        return $this->bodySchema;
    }

    /**
     * @return bool
     */
    public function isJsonBody(): bool
    {
        return $this->jsonBody;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return array
     * @throws MissingPropertyBodySchemaException
     */
    public function build(): array
    {
        if (count($this->bodySchema) === 0) {
            return [];
        }

        $data = [];

        foreach ($this->bodySchema as $property) {
            if (!property_exists($this, $property)) {
                throw new MissingPropertyBodySchemaException($property, $this);
            }

            $data[$property] = $this->{$property};
        }

        return json_decode(json_encode($data), true);
    }
}

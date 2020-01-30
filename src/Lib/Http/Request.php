<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Exception\MissingPropertyBodySchemaException;
use Jetimob\Juno\Util\Log;

abstract class Request
{
    protected string $responseClass;

    /**
     * Defines all class properties that should be sent with the request.
     * The access level of the property must be protected or public.
     * @var array $bodySchema
     */
    protected array $bodySchema = [];

    protected string $bodyType = BodyType::JSON;

    /**
     * UNIX timestamp of the moment of the request.
     * @var int $timestamp
     */
    private int $timestamp;

    public function __construct()
    {
        $this->timestamp = time();

        if (empty($this->responseClass)) {
            $this->responseClass = preg_replace(
                '/Request$/',
                '$1Response',
                get_called_class()
            );
        }
    }

    /**
     * Every extending class MUST declare its method of request.
     * @return string
     */
    abstract protected function method(): string;

    /**
     * Every extending class MUST declare its urn.
     * @return string
     */
    abstract protected function urn(): string;

    final public function getMethod(): string
    {
        return $this->method();
    }

    /**
     * @return string
     */
    final public function getUrn(): string
    {
        $matches = [];
        $urn = $this->urn();

        if (preg_match('/{([[:alpha:]]+?)}/', $urn, $matches)) {
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
    final public function getResponseClass(): string
    {
        return $this->responseClass;
    }

    /**
     * @return array
     */
    final public function getBodySchema(): array
    {
        return $this->bodySchema;
    }

    /**
     * @return string
     */
    final public function getBodyType(): string
    {
        return $this->bodyType;
    }

    /**
     * @return int
     */
    final public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return array
     * @throws MissingPropertyBodySchemaException
     */
    public function build(): array
    {
        $schema = $this->getBodySchema();

        if (count($schema) === 0) {
            return [];
        }

        $data = [];

        foreach ($schema as $property) {
            if (!property_exists($this, $property)) {
                throw new MissingPropertyBodySchemaException($property, $this);
            }

            if (!isset($this->{$property})) {
                continue;
            }

            $data[$property] = $this->{$property};
        }

        return json_decode(json_encode($data), true);
    }
}

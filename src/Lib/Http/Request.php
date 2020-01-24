<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Exception\MissingPropertyBodySchemaException;
use Jetimob\Juno\Util\Log;

abstract class Request
{
    protected string $responseClass;

    protected array $bodySchema = [];

    protected bool $jsonBody = true;

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

    public function getMethod(): string
    {
        return $this->method();
    }

    /**
     * @return string
     */
    public function getUrn(): string
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
        if (count($this->getBodySchema()) === 0) {
            return [];
        }

        $data = [];

        foreach ($this->getBodySchema() as $property) {
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

    /**
     * @param int|string $year
     * @param int|string $month
     * @param int|string $day
     * @return string
     */
    public function formatDate($year, $month, $day): string
    {
        return sprintf('%s-%s-%s', $year, $month, $day);
    }

}

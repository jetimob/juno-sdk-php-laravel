<?php

namespace Jetimob\Juno\Api;

use Jetimob\Http\Request;
use Jetimob\Juno\Exception\InvalidArgumentException;
use Jetimob\Juno\Exception\JunoRequestException;
use Jetimob\Juno\Juno;

abstract class AbstractApi extends \Jetimob\Http\AbstractApi
{
    private string $resourceToken;
    protected ?string $exceptionClass = JunoRequestException::class;

    /**
     * AbstractApi constructor.
     * @param Juno $juno
     */
    public function __construct(Juno $juno)
    {
        parent::__construct($juno);
        $this->resourceToken = config('juno.resource_token', '');
    }

    /**
     * @return string
     */
    public function getResourceToken(): string
    {
        return $this->resourceToken;
    }

    /**
     * Sobrescreve o X-Resource-Token da próxima requisição.
     *
     * @param string $resourceToken
     * @return $this
     */
    public function setResourceToken(string $resourceToken): self
    {
        $this->resourceToken = $resourceToken;
        return $this;
    }

    /**
     * Sobrescreve o X-Resource-Token da próxima requisição.
     *
     * @param string $resourceToken
     * @return $this
     */
    public function using(string $resourceToken): self
    {
        if (empty($resourceToken)) {
            throw new InvalidArgumentException('O token de recurso NÃO pode ser vazio!');
        }

        $this->resourceToken = $resourceToken;
        return $this;
    }

    protected function makeBaseRequest($method, $path, array $headers = [], $body = null): Request
    {
        return (new AuthorizedRequest($method, $path, $headers, $body))
            ->withAddedHeader('X-Resource-Token', $this->resourceToken);
    }
}

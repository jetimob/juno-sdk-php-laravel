<?php

namespace Jetimob\Juno\Api;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\RequestOptions;
use Jetimob\Http\Http;
use Jetimob\Juno\Exception\JunoRequestException;
use Jetimob\Juno\Juno;

abstract class AbstractApi
{
    private Http $client;
    private string $resourceToken;

    /**
     * AbstractApi constructor.
     * @param Juno $juno
     */
    public function __construct(Juno $juno)
    {
        $this->client = $juno->getClient();
        $this->resourceToken = config('juno.resource_token', '');
    }

    /**
     * @return string
     */
    public function getResourceToken(): string
    {
        return $this->resourceToken;
    }

    public function setResourceToken(string $resourceToken): self
    {
        $this->resourceToken = $resourceToken;
        return $this;
    }

    public function using(string $resourceToken): self
    {
        $this->resourceToken = $resourceToken;
        return $this;
    }

    /**
     * @param RequestException | ClientException $exception
     * @return JunoRequestException
     * @throws \JsonException
     */
    protected function wrapException($exception): JunoRequestException
    {
        $junoException = new JunoRequestException(
            $exception->getMessage(),
            $exception->getRequest(),
            $exception->getResponse(),
            $exception->getPrevious(),
            $exception->getHandlerContext(),
        );

        $response = $exception->getResponse();

        if (is_null($response)) {
            return $junoException;
        }

        $data = $response->getBody()->getContents();
        $response->getbody()->rewind();

        $decodedData = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        if (empty($decodedData)) {
            return $junoException;
        }

        $junoException->hydrate($decodedData);

        return $junoException;
    }

    /**
     * @throws \JsonException
     */
    protected function mappedRequest(
        string $method,
        string $path,
        string $responseClass,
        $body,
        $headers
    ): JunoResponse {
        if (empty($headers)) {
            $headers = [];
        }

        if ($body && is_array($body)) {
            if (array_key_exists(RequestOptions::JSON, $body)) {
                $headers['Content-Type'] = 'application/json';
                $body = json_encode($body[RequestOptions::JSON], JSON_THROW_ON_ERROR);
            } elseif (array_key_exists(RequestOptions::QUERY, $body)) {
                $qParams = $body[RequestOptions::QUERY];

                if (!is_array($qParams)) {
                    $qParams = array_filter((array) $qParams, static fn ($val) => !is_null($val));
                }

                $path .= '?' . Query::build($qParams ?? []);
                $body = null;
            } elseif (array_key_exists(RequestOptions::MULTIPART, $body)) {
                $body = new MultipartStream($body[RequestOptions::MULTIPART]);
                $headers['Content-Type'] = 'multipart/form-data; boundary=' . $body->getBoundary();
            }
        }

        // Identifica a conta digital que deverá ser utilizada durante a execução desta operação.
        $headers['X-Resource-Token'] = $this->resourceToken;

        try {
            return $this->client->sendExpectingResponseClass(
                new AuthorizedRequest($method, $path, $headers, $body),
                $responseClass,
            );
        } catch (RequestException | ClientException $e) {
            throw $this->wrapException($e);
        }
    }

    /**
     * @throws \JsonException
     */
    protected function request(string $method, string $path): \GuzzleHttp\Psr7\Response
    {
        try {
            return $this->client->send(
                new AuthorizedRequest($method, $path)
            );
        } catch (RequestException | ClientException $e) {
            throw $this->wrapException($e);
        }
    }

    protected function mappedGet(string $path, string $responseClass, $body = null, $headers = []): JunoResponse
    {
        return $this->mappedRequest('get', $path, $responseClass, $body, $headers);
    }

    protected function mappedPut(string $path, string $responseClass, $body = null, $headers = []): JunoResponse
    {
        return $this->mappedRequest('put', $path, $responseClass, $body, $headers);
    }

    protected function mappedPost(string $path, string $responseClass, $body = null, $headers = []): JunoResponse
    {
        return $this->mappedRequest('post', $path, $responseClass, $body, $headers);
    }

    protected function mappedPatch(string $path, string $responseClass, $body = null, $headers = []): JunoResponse
    {
        return $this->mappedRequest('patch', $path, $responseClass, $body, $headers);
    }
}

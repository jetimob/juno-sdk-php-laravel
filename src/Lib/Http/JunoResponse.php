<?php

namespace Jetimob\Juno\Lib\Http;

use Jetimob\Juno\Exception\JunoResponseException;
use Psr\Http\Message\ResponseInterface;

class JunoResponse
{
    private bool $successful;

    private int $code;

    // ----- ERROR PROPERTIES -----

    private string $timestamp;

    private int $status;

    private string $error;

    private array $details;

    private string $path;

    /**
     * JunoResponse constructor.
     * @param ResponseInterface $response
     * @throws JunoResponseException
     */
    public function __construct(ResponseInterface $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);

        if ($data === null || $data === false) {
            throw new JunoResponseException('unable to decode Juno\'s API response');
        }

        if (array_key_exists('error', )) {
            $this->constructFromError($response, $data);
        } else {
            $this->constructFromSuccess($response, $data);
        }
    }

    private function constructFromError(ResponseInterface $response, array $body)
    {
        $this->successful = false;
    }

    private function constructFromSuccess(ResponseInterface $response, array $body)
    {
        $this->successful = true;
    }

    public function __toString()
    {
        return '';
    }
}

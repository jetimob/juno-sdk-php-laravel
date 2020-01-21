<?php

namespace Jetimob\Juno;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Exception\JunoCastException;
use Jetimob\Juno\Exception\JunoException;
use Jetimob\Juno\Lib\Http\Authorization\AuthorizationRequest;
use Jetimob\Juno\Lib\Http\Authorization\AuthorizationResponse;
use Jetimob\Juno\Lib\Http\ErrorResponse;
use Jetimob\Juno\Lib\Http\Request;
use Jetimob\Juno\Lib\Http\Response;
use Illuminate\Support\Facades\Log;
use Jetimob\Juno\Util\Console;

/**
 * Class Juno
 * @package Jetimob\Juno
 */
class Juno
{
    private array $config;

    private Client $apiClient;

    private Client $authzClient;

    /**
     * Juno constructor.
     * @param array $config
     * @throws JunoException
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
        $gruzzleOptions = array_key_exists('gruzzle', $config) ? $config['gruzzle'] : [];

        // check if we got all required keys in the config file
        foreach (self::CONFIG_REQUIRED_KEYS as $key) {
            if (!array_key_exists($key, $config)) {
                Log::info('config', $config);
                throw new JunoException(sprintf(
                    'missing required keys in juno\'s configuration file [%s]',
                    implode(', ', self::CONFIG_REQUIRED_KEYS),
                ));
            }
        }

        $apiClientOptions = array_merge($gruzzleOptions, [
            RequestOptions::HEADERS => [
                'X-Api-Version' => $config['version'],
                'Authorization' => sprintf('Bearer %s', $this->getAccessToken()),
            ],
        ]);

        $authzClientOptions = array_merge($gruzzleOptions, [
            RequestOptions::HEADERS => [
                'Authorization' => sprintf(
                    'Basic %s',
                    base64_encode(sprintf('%s:%s', $config['clientId'], $config['secret']))
                ),
            ],
        ]);

        $env = $config['environment'] ?? null;

        if (empty($env)) {
            Log::error('environment was not set in Juno\'s configuration file');
            return;
        }

        if ($env === 'development') {
            $env = 'sandbox';
        } elseif ($env !== 'sandbox' && $env !== 'production') {
            Log::error('juno\'s environment can only be set to "development", "production" or "sandbox"');
            return;
        }

        // set the API base_uri accordingly to the environment
        $apiClientOptions['base_uri'] = $gruzzleOptions['base_uri'][$env];
        $this->apiClient = new Client($apiClientOptions);

        $authzClientOptions['base_uri'] = $gruzzleOptions['authorization_base_uri'][$env];
        $this->authzClient = new Client($authzClientOptions);
    }

    private function getAccessToken(): string
    {
        return '';
    }

    public function requestAccessToken(): AuthorizationResponse
    {
        return $this->request(new AuthorizationRequest(), $this->authzClient);
    }

    /**
     * @param Request|string $request
     * @param Client|null $client
     * @return Response
     * @throws Exception\MissingPropertyBodySchemaException
     * @throws JunoCastException
     * @throws ErrorResponse
     * @throws Exception\JunoResponseException
     */
    public function request($request, $client = null): Response
    {
        if (is_string($request)) {
            $request = new $request();
        }

        if (is_null($client)) {
            $client = $this->apiClient;
        }

        $instance = null;
        Console::log($request->build());

        try {
            $response = $client->request(
                $request->getMethod(),
                $request->getUrn(),
                [
                    'json' => $request->build()
                ]
            );

            $refl = new \ReflectionClass($request->getResponseClass());
            $instance = $refl->newInstanceArgs([$response]);
        } catch (ClientException $e) {
            throw new ErrorResponse($e->getResponse());
        } catch (\Exception $e) {
            Console::log($e);
            throw new JunoCastException('', '', $e);
        }

        return $instance;
    }

    private const CONFIG_REQUIRED_KEYS = [
        'clientId', 'secret', 'version'
    ];
}


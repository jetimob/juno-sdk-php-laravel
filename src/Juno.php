<?php

namespace Jetimob\Juno;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Cache;
use Jetimob\Juno\Exception\EmptyResponseClassException;
use Jetimob\Juno\Exception\JunoAccessTokenRejection;
use Jetimob\Juno\Exception\JunoCastException;
use Jetimob\Juno\Exception\JunoException;
use Jetimob\Juno\Exception\MissingPropertyBodySchemaException;
use Jetimob\Juno\Exception\WrongRequestTypeException;
use Jetimob\Juno\Exception\WrongResponseTypeException;
use Jetimob\Juno\Lib\Http\Authorization\AuthorizationRequest;
use Jetimob\Juno\Lib\Http\Authorization\AuthorizationResponse;
use Jetimob\Juno\Lib\Http\ErrorResponse;
use Jetimob\Juno\Lib\Http\Request;
use Jetimob\Juno\Lib\Http\Response;
use Jetimob\Juno\Util\Log;

/**
 * Class Juno
 * @package Jetimob\Juno
 */
class Juno
{
    /** @var string AUTHZ_CACHE_KEY is the key used to store an authorization token in cache */
    private const AUTHZ_CACHE_KEY = 'juno:authorization:token';
    private const ACCESS_TOKEN_RETRIEVAL_MAX_ATTEMPTS = 5;

    private int $accessTokenCurrentAttempt = 0;

    private array $config;

    private array $gruzzleOptions;

    private AuthorizationResponse $authorization;

    private Client $apiClient;

    private Client $authzClient;

    /**
     * Juno constructor.
     *
     * @param array $config
     * @throws JunoException
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
        $this->gruzzleOptions = array_key_exists('gruzzle', $config) ? $config['gruzzle'] : [];

        // check if we got all required keys in the config file
        foreach (self::CONFIG_REQUIRED_KEYS as $key) {
            if (!array_key_exists($key, $config) || empty($config[$key])) {
                Log::info('config', $config);
                throw new JunoException(sprintf(
                    'missing required keys in juno\'s configuration file [%s]',
                    implode(', ', self::CONFIG_REQUIRED_KEYS),
                ));
            }
        }

        $authzClientOptions = array_merge($this->gruzzleOptions, [
            RequestOptions::HEADERS => [
                'Authorization' => sprintf(
                    'Basic %s',
                    base64_encode(sprintf('%s:%s', $config['clientId'], $config['secret']))
                ),
            ],
        ]);

        $authzClientOptions['base_uri'] = $this->gruzzleOptions['authorization_base_uri'][$this->getEnv()];
        $this->authzClient = new Client($authzClientOptions);
        $this->initApiClient();
    }

    /**
     * Returns true if the access token is valid, false otherwise
     *
     * @return bool
     */
    private function checkAccessTokenValidity(): bool
    {
        if (is_null($this->authorization) || $this->authorization->failed()) {
            return false;
        }

        return ($this->authorization->getTimestamp() + $this->authorization->getExpiresIn()) > time();
    }


    /**
     * Handles the lifecycle of a Juno's access token.
     * Tries to get one from te cache, and if not found, a new one will be requested in Juno's authorization endpoint.
     *
     * @return AuthorizationResponse
     * @throws JunoAccessTokenRejection
     * @throws JunoCastException
     * @throws MissingPropertyBodySchemaException
     * @throws WrongResponseTypeException
     * @throws WrongRequestTypeException
     */
    private function retrieveAccessToken(): AuthorizationResponse
    {
        $cached = Cache::get(self::AUTHZ_CACHE_KEY);

        if (!is_null($cached)) {
            return $cached;
        }

        /** @var AuthorizationResponse $response */
        $response = $this->request(AuthorizationRequest::class, $this->authzClient);

        if ($response->failed()) {
            return $response;
        }

        Cache::put(self::AUTHZ_CACHE_KEY, $response, now()->addSeconds($response->getExpiresIn()));
        return $response;
    }

    /**
     * Makes a request to Juno's resource API.
     * Expects the $request to be an instance of Request, will throw a error if the given request is not valid.
     *
     * All errors can be easily handled if catching JunoException. All exceptions thrown derive from this base.
     *
     * Every request made returns an instance of an object defined by the request $responseClass property. I.e.: The
     * ChargeCreationRequest class has the property $responseClass assigned to ChargeCreationResponse::class.
     *
     * @example
     * <code>
     * request(ChargeCreationRequest::class): ChargeCreationResponse
     * request(AuthorizationRequest::class): AuthorizationResponse
     * </code>
     *
     * @param Request|string $request
     * @param Client|null $client
     * @return ErrorResponse|Response|null
     * @throws JunoAccessTokenRejection
     * @throws JunoCastException
     * @throws MissingPropertyBodySchemaException
     * @throws WrongRequestTypeException
     * @throws WrongResponseTypeException
     */
    public function request($request, Client $client = null)
    {
        // accept strings so that we can use ::class notation
        if (is_string($request)) {
            $request = new $request();
        }

        if (is_null($client)) {
            $client = $this->apiClient;
        }

        if (is_null($request) || !($request instanceof Request)) {
            throw new WrongRequestTypeException($request);
        }

        $instance = null;
        $requestBodyType = $request->isJsonBody() ? 'json' : 'form_params';
        $requestOptions = [
            $requestBodyType => $request->build(),
        ];

        // ALL requests (excluding AuthorizationRequest) MUST include the access token bearer authorization
        if (!($request instanceof AuthorizationRequest)) {
            $requestOptions[RequestOptions::HEADERS] = [
                'Authorization' => sprintf('Bearer %s', $this->getAccessToken()),
            ];
        }

        try {
            $response = $client->request($request->getMethod(), $request->getUrn(), $requestOptions);
            $className = $request->getResponseClass();

            if (empty($className)) {
                throw new EmptyResponseClassException(get_class($request));
            }

            if (!method_exists($className, 'deserialize')) {
                throw new WrongResponseTypeException();
            }

            /** @var Response $instance */
            $instance = $className::deserialize($response->getBody()->getContents());
            $instance->setStatusCode($response->getStatusCode());
        } catch (ClientException | ServerException $e) {
            $instance = ErrorResponse::deserialize($e->getResponse()->getBody()->getContents());
        } catch (Exception $e) {
            throw new JunoCastException($e);
        }

        $instance->initComplexObjects();
        return $instance;
    }

    /**
     * Returns an access token for Juno's API.
     * Firstly it'll try to get the token from the cache and if there is none cached, a new one will be generated.
     * The new token will be cached and validated.
     *
     * @return string
     * @throws JunoAccessTokenRejection
     * @throws JunoCastException
     * @throws WrongResponseTypeException
     * @throws WrongRequestTypeException
     * @throws MissingPropertyBodySchemaException
     */
    private function getAccessToken(): string
    {
        $token = $this->retrieveAccessToken();

        if ($token->failed()) {
            throw new JunoAccessTokenRejection();
        }

        $this->authorization = $token;

        if (!$this->checkAccessTokenValidity()) {
            if ($this->accessTokenCurrentAttempt++ === self::ACCESS_TOKEN_RETRIEVAL_MAX_ATTEMPTS) {
                throw new JunoAccessTokenRejection();
            }
            // empty the cache so that the next call to retrieveAccessToken will make a request to a new access token
            Cache::forget(self::AUTHZ_CACHE_KEY);
            return $this->getAccessToken();
        }

        $this->accessTokenCurrentAttempt = 0;
        return $this->authorization->getAccessToken();
    }

    /**
     * Returns the string representation of the current environment, set it the configuration file.
     * Can be 'production' or 'sandbox';
     *
     * @return string
     */
    private function getEnv(): string
    {
        $env = $this->config['environment'] ?? null;

        if (empty($env)) {
            Log::error('environment was not set in Juno\'s configuration file');
            return 'sandbox';
        }

        if ($env === 'development') {
            $env = 'sandbox';
        } elseif ($env !== 'sandbox' && $env !== 'production') {
            Log::error('juno\'s environment can only be set to "development", "production" or "sandbox"');
            return 'sandbox';
        }

        return $env;
    }

    /**
     * Initializes the API HTTP client with default and override options.
     *
     * @param array $overrideOptions
     */
    private function initApiClient(array $overrideOptions = []): void
    {
        $apiClientOptions = array_merge($this->gruzzleOptions, array_merge($this->makeApiHeaders(), $overrideOptions));
        // overrides the base_uri accordingly to the environment
        $apiClientOptions['base_uri'] = $this->gruzzleOptions['base_uri'][$this->getEnv()];
        $this->apiClient = new Client($apiClientOptions);
    }

    /**
     * Returns the necessary API headers to a request be considered valid.
     *
     * @param array $with - merges custom headers with the default ones.
     * @return array
     */
    private function makeApiHeaders(array $with = []): array
    {
        return [
            RequestOptions::HEADERS => array_merge([
                'X-Api-Version' => $this->config['version'],
                'X-Resource-Token' => $this->config['private_token'],
            ], $with),
        ];
    }

    /**
     * Overrides the X-Resource-Token header so the next request will be identified by it.
     *
     * @param string $privateToken
     * @return Juno
     */
    public function as(string $privateToken): Juno
    {
        $this->initApiClient($this->makeApiHeaders([
            'X-Resource-Token' => $privateToken,
        ]));

        return $this;
    }

    /**
     * Resets the X-Resource-Token header.
     *
     * @return Juno
     */
    public function resetResourceToken(): Juno
    {
        $this->initApiClient();
        return $this;
    }

    private const CONFIG_REQUIRED_KEYS = [
        'clientId', 'secret', 'version'
    ];
}

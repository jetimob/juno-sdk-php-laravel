<?php

namespace Jetimob\Juno;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Illuminate\Encryption\Encrypter;
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
use Throwable;

/**
 * Class Juno
 * @package Jetimob\Juno
 */
class Juno
{
    /** @var string AUTHZ_CACHE_KEY is the key used to store an authorization token in cache */
    public const AUTHZ_CACHE_KEY = 'juno:authorization:token';

    /** @var mixed|string $resourceToken identifies the main account resource token */
    private string $resourceToken;

    private int $currentRequestAttempt = 0;

    private int $requestAttemptDelay;

    private int $requestMaxAttempts;

    private array $config;

    private array $gruzzleOptions;

    private AuthorizationResponse $authorization;

    private Client $apiClient;

    private Client $authzClient;

    private ?Encrypter $encrypter = null;

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
        $this->requestMaxAttempts = $config['request_max_attempts'];
        $this->requestAttemptDelay = $config['request_attempt_delay'];

        $encryptionKey = $this->getConfig('request_encryption_key');
        $encryptionCipher = $this->getConfig('request_encryption_cipher');

        if (!empty($encryptionKey) && !empty($encryptionCipher)) {
            $this->encrypter = new Encrypter($encryptionKey, $encryptionCipher);
        }

        // check if we got all required keys in the config file
        foreach (self::CONFIG_REQUIRED_KEYS as $key) {
            if (!array_key_exists($key, $config) || empty($config[$key])) {
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

        Log::$enabled = $config['logging'];
        $this->resourceToken = $config['private_token'];
    }

    /**
     * Returns true if the access token is valid, false otherwise
     *
     * @return bool
     */
    private function isAccessTokenValid(): bool
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
     * @return Response
     * @throws JunoAccessTokenRejection
     * @throws JunoCastException
     * @throws MissingPropertyBodySchemaException
     * @throws WrongResponseTypeException
     * @throws WrongRequestTypeException
     * @throws JunoException
     */
    private function retrieveAccessToken(): Response
    {
        $cached = Cache::get(self::AUTHZ_CACHE_KEY);

        if (!is_null($cached)) {
            return $cached;
        }

        /** @var AuthorizationResponse $response */
        $response = $this->request(AuthorizationRequest::class, $this->resourceToken, $this->authzClient);

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
     * @param string $resourceToken
     * @param Client|null $client
     * @return ErrorResponse|Response|null
     * @throws JunoAccessTokenRejection
     * @throws JunoCastException
     * @throws MissingPropertyBodySchemaException
     * @throws WrongRequestTypeException
     * @throws WrongResponseTypeException
     * @throws JunoException
     */
    public function request($request, string $resourceToken, Client $client = null)
    {
        $this->as($resourceToken);

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
        $builtBody = $request->build();
        $requestOptions = [];

        if (count($builtBody) > 0) {
            $requestOptions[$request->getBodyType()] = $builtBody;
        }

        // ALL requests (excluding AuthorizationRequest) MUST include the access token bearer authorization
        if (!($request instanceof AuthorizationRequest)) {
            $requestOptions[RequestOptions::HEADERS] = [
                'Authorization' => sprintf('Bearer %s', $this->getAccessToken()),
            ];
        }

        if (!is_null($this->encrypter)) {
            $requestOptions[$request->getBodyType()] = [$this->encrypter->encrypt([
                'request_type' => get_class($request),
                'options' => array_merge(json_decode(json_encode($client->getConfig()), true), $requestOptions),
                'method' => $request->getMethod(),
                'urn' => $request->getUrn(),
            ])];
        }

        $failedAfterMaxAttempts = false;

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
            $statusCode = $e->getCode();
            $setInstanceFromError = static function () use (&$instance, $e) {
                $instance = ErrorResponse::deserialize($e->getResponse()->getBody()->getContents());
                $instance->setStatusCode($e->getCode());
            };

            if (!$this->getConfig('enable_recover_attempt', false)) {
                $setInstanceFromError();
            } else {
                if (!in_array($statusCode, $this->getConfig('recoverable_status_codes', []))) {
                    $setInstanceFromError();
                    $this->logRequestError(
                        'request failed with an unrecoverable status code',
                        $request,
                        $statusCode,
                    );
                } elseif ($this->currentRequestAttempt++ === $this->requestMaxAttempts) {
                    $this->logRequestError('request failed after max attempts reached', $request, $statusCode);
                    $setInstanceFromError();
                    $failedAfterMaxAttempts = true;
                } else {
                    usleep($this->requestAttemptDelay * 1000);
                    return $this->request(...func_get_args());
                }
            }
        } catch (Throwable $e) {
            $this->currentRequestAttempt = 0;
            throw new JunoException($e);
        }

        if ($this->currentRequestAttempt > 0 && !$failedAfterMaxAttempts) {
            Log::warning('request succeeded after more than one attempt', [
                'attempts' => $this->currentRequestAttempt,
                'urn' => $request->getUrn(),
                'method' => $request->getMethod(),
            ]);
        }

        $this->currentRequestAttempt = 0;
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
     * @throws JunoException
     */
    private function getAccessToken(): string
    {
        $token = $this->retrieveAccessToken();

        if ($token->failed()) {
            throw new JunoAccessTokenRejection($token);
        }

        /** @var AuthorizationResponse $token */
        $this->authorization = $token;

        // we probably got an expired cached token
        if (!$this->isAccessTokenValid()) {
            // empty the cache so that the next call to retrieveAccessToken will make a request to a new access token
            Cache::forget(self::AUTHZ_CACHE_KEY);
            return $this->getAccessToken();
        }

        return $this->authorization->getAccessToken();
    }

    /**
     * Returns the string representation of the current environment, set it the configuration file.
     * Can be 'production' or 'sandbox';
     *
     * @return string
     */
    public function getEnv(): string
    {
        $env = $this->getConfig('environment');

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
    public function makeApiHeaders(array $with = []): array
    {
        return [
            RequestOptions::HEADERS => array_merge([
                'X-Api-Version' => $this->getConfig('version', 2),
                'X-Resource-Token' => $this->getConfig('private_token'),
            ], $with),
        ];
    }

    /**
     * Overrides the X-Resource-Token header so the next request will be identified by it.
     *
     * @param string $privateToken
     * @return Juno
     */
    private function as(string $privateToken): Juno
    {
        $this->initApiClient($this->makeApiHeaders([
            'X-Resource-Token' => $privateToken,
        ]));

        return $this;
    }

    /**
     * Returns a date formatted string (YYYY-MM-DD)
     *
     * @param int|string $year
     * @param int|string $month
     * @param int|string $day
     * @return string
     */
    public static function formatDate($year, $month, $day): string
    {
        return sprintf('%s-%02s-%02s', $year, $month, $day);
    }

    /**
     * Returns a datetime formatted string (YYYY-MM-DD HH:mm:ss)
     *
     * @param int|string $year
     * @param int|string $month
     * @param int|string $day
     * @param int|string $hour
     * @param int|string $minute
     * @param int|string $second
     * @return string
     */
    public static function formatDateTime($year, $month, $day, $hour = 0, $minute = 0, $second = 0): string
    {
        return sprintf(
            '%s %02s:%02s:%02s',
            self::formatDate($year, $month, $day),
            $hour,
            $minute,
            $second,
        );
    }

    private function logRequestError(string $message, Request $request, $statusCode): void
    {
        Log::error($message, [
            'urn' => $request->getUrn(),
            'method' => $request->getMethod(),
            'status_code' => $statusCode,
            'attempts' => $this->currentRequestAttempt,
        ]);
    }

    /**
     * Returns the configuration value from a given key. Default value is returned if the key is not found.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public function getConfig(string $key, $default = null) {
        return array_key_exists($key, $this->config) ? $this->config[$key] : $default;
    }

    private const CONFIG_REQUIRED_KEYS = [
        'clientId', 'secret', 'version'
    ];
}

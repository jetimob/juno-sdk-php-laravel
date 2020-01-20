<?php

namespace Jetimob\Juno;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Exception\JunoCastException;
use Jetimob\Juno\Exception\JunoException;
use Jetimob\Juno\Lib\Billet;
use Jetimob\Juno\Lib\Http\Request;
use Jetimob\Juno\Lib\Http\Response;

/**
 * Class Juno
 * @package Jetimob\Juno
 * @property Billet $billet
 */
class Juno
{
    private array $config;

    private array $instances = [];

    private Client $client;

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
                throw new JunoException(sprintf(
                    'missing required keys in juno\'s configuration file [%s]',
                    implode(', ', self::CONFIG_REQUIRED_KEYS),
                ));
            }
        }

        $gruzzleOptions = [
            ...$gruzzleOptions,
            RequestOptions::AUTH => [
                $config['clientId'], $config['secret'], 'basic',
            ],
            RequestOptions::HEADERS => [
                'X-Api-Version' => $config['version'],
            ],
        ];

        $this->client = new Client($gruzzleOptions);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Exception\MissingPropertyBodySchemaException
     * @throws JunoCastException
     */
    public function request(Request $request): Response
    {
        $response = $this->client->request(
            $request->getMethod(),
            $request->getUrn(),
            [
                'json' => $request->build()
            ]
        );

        $castResponse = null;

        try {
            $castResponse = new ($request->getResponseClass())($response);
        } catch (\Exception $e) {
            throw new JunoCastException('', '', $e);
        }

        return $castResponse;
    }

    private const CONFIG_REQUIRED_KEYS = [
        'clientId', 'secret', 'version'
    ];
}


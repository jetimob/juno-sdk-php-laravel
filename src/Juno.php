<?php

namespace Jetimob\Juno;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Exception\JunoException;
use Jetimob\Juno\Lib\Billet;

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
                    'Missing required keys in juno\'s configuration file [%s]',
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

    public function request()
    {
        $this->client->request('', );
    }

    public function __get($arg)
    {
        if (!array_key_exists($arg, $this->instances)) {
            $this->instances[$arg] = JunoFactory::make($arg, $this);
        }

        return $this->instances[$arg];
    }

    private const CONFIG_REQUIRED_KEYS = [
        'clientId', 'secret', 'version'
    ];
}

